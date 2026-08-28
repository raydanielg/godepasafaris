<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuLink;
use App\Models\MenuSection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Mega Menu Manager.
 *
 * Lets an admin edit the navbar mega menus — the right-hand feature card and the
 * left-hand shortcut links — without touching Blade. Backed by the menu_sections
 * and menu_links tables that already drove the mobile sidebar.
 *
 * Image handling deliberately mirrors BackgroundController: uploads are moved
 * into public/uploads/… and stored as a relative path, because this app is on
 * cPanel shared hosting where the storage symlink is not reliable. No second
 * storage mechanism is introduced.
 */
class MegaMenuController extends Controller
{
    /** Where feature-card uploads live, relative to public/. */
    private const UPLOAD_DIR = 'uploads/menu';

    /**
     * Show the manager for one nav item. The category picker drives this via a
     * ?section= query param; anything unknown falls back to the first nav item.
     */
    public function index(Request $request)
    {
        $navItem = $request->query('section');

        if (! array_key_exists($navItem, MenuSection::NAV_ITEMS)) {
            $navItem = array_key_first(MenuSection::NAV_ITEMS);
        }

        // Create the row on first visit so the admin always has something to
        // edit, even for a nav item that was never seeded.
        $section = MenuSection::firstOrCreate(
            ['nav_item' => $navItem],
            [
                'title'         => MenuSection::NAV_ITEMS[$navItem],
                'badge_color'   => 'success',
                'display_order' => 1,
                'is_active'     => true,
            ]
        );

        $links = $section->links()->orderBy('display_order')->orderBy('id')->get();

        return view('admin.mega-menu.index', [
            'navItems' => MenuSection::NAV_ITEMS,
            'navItem'  => $navItem,
            'section'  => $section,
            'links'    => $links,
            'colors'   => MenuSection::BADGE_COLORS,
        ]);
    }

    /** Save the right-hand feature card (text, badge, CTA, image). */
    public function updateSection(Request $request, MenuSection $section)
    {
        $data = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string', 'max:2000'],
            'badge'            => ['nullable', 'string', 'max:60'],
            'badge_color'      => ['nullable', Rule::in(MenuSection::BADGE_COLORS)],
            'link_text'        => ['nullable', 'string', 'max:80'],
            'link_url'         => ['nullable', 'string', 'max:255', $this->urlRule()],
            'image_url'        => ['nullable', 'string', 'max:2048', $this->urlRule()],
            'image'            => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
            'is_active'        => ['nullable', 'boolean'],
            'use_custom_content' => ['nullable', 'boolean'],
        ], [
            'image.image' => 'The feature image must be a JPG, PNG or WebP file.',
            'image.max'   => 'The feature image must be 4 MB or smaller.',
        ]);

        $section->fill([
            'title'            => $data['title'],
            'description'      => $data['description'] ?? null,
            'badge'            => $data['badge'] ?? null,
            'badge_color'      => $data['badge_color'] ?? 'success',
            'link_text'        => $data['link_text'] ?? null,
            'link_url'         => $data['link_url'] ?? null,
            'is_active'        => $request->boolean('is_active'),
            'use_custom_content' => $request->boolean('use_custom_content'),
        ]);

        // Image precedence, matching the backgrounds screen: remove wins, then an
        // uploaded file, then a pasted URL. Anything else leaves the image as-is.
        if ($request->boolean('remove_image')) {
            $this->deleteUpload($section->image);
            $section->image = null;
        } elseif ($request->hasFile('image')) {
            $old = $section->image;

            // A write failure here is almost always a folder-permission problem
            // on the server. Report it as a form error the admin can act on,
            // rather than letting it surface as a blank 500 page.
            try {
                $section->image = $this->storeUpload($request->file('image'));
            } catch (\Throwable $e) {
                \Log::error('Mega menu image upload failed: ' . $e->getMessage());

                return back()
                    ->withInput()
                    ->withErrors(['image' => $e->getMessage()]);
            }

            $this->deleteUpload($old);
        } elseif (! empty($data['image_url'])) {
            $this->deleteUpload($section->image);
            $section->image = trim($data['image_url']);
        }

        $section->save(); // model event flushes the mega-menu cache

        return back()->with('success', 'Feature card updated. The change is live on the site now.');
    }

    /** Add a shortcut link to the left-hand list. */
    public function storeLink(Request $request, MenuSection $section)
    {
        $data = $this->validateLink($request);

        $data['menu_section_id'] = $section->id;
        $data['display_order'] = (int) $section->links()->max('display_order') + 1;

        MenuLink::create($data);

        return back()->with('success', 'Shortcut link added.');
    }

    public function updateLink(Request $request, MenuLink $link)
    {
        $link->update($this->validateLink($request));

        return back()->with('success', 'Shortcut link updated.');
    }

    public function destroyLink(MenuLink $link)
    {
        $link->delete();

        return back()->with('success', 'Shortcut link deleted.');
    }

    /** Flip a link between shown and hidden without deleting it. */
    public function toggleLink(MenuLink $link)
    {
        $link->update(['is_active' => ! $link->is_active]);

        return back()->with('success', $link->is_active
            ? 'Link is now visible in the menu.'
            : 'Link hidden from the menu (not deleted).');
    }

    /**
     * Move one link up or down. Swapping with the neighbour keeps the ordering
     * stable even when display_order values have gaps or duplicates.
     */
    public function moveLink(Request $request, MenuLink $link)
    {
        $direction = $request->input('direction') === 'up' ? 'up' : 'down';

        $siblings = MenuLink::where('menu_section_id', $link->menu_section_id)
            ->orderBy('display_order')
            ->orderBy('id')
            ->get();

        $index = $siblings->search(fn ($l) => $l->id === $link->id);
        $target = $direction === 'up' ? $index - 1 : $index + 1;

        if ($index === false || $target < 0 || $target >= $siblings->count()) {
            return back(); // already at the end — nothing to do
        }

        // Renumber the whole list from the reordered sequence so the result is
        // always a clean 1..n with no gaps, whatever the data looked like before.
        $ordered = $siblings->values()->all();
        [$ordered[$index], $ordered[$target]] = [$ordered[$target], $ordered[$index]];

        foreach ($ordered as $position => $item) {
            $item->update(['display_order' => $position + 1]);
        }

        return back();
    }

    private function validateLink(Request $request): array
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'icon'        => ['nullable', 'string', 'max:60', 'regex:/^[a-z0-9\- ]*$/i'],
            'url'         => ['required', 'string', 'max:255', $this->urlRule()],
            'badge'       => ['nullable', 'string', 'max:40'],
            'badge_color' => ['nullable', Rule::in(MenuSection::BADGE_COLORS)],
            'is_active'   => ['nullable', 'boolean'],
        ], [
            'icon.regex' => 'Use a Font Awesome icon name such as "fa-mountain".',
            'url.regex'  => 'Enter a site path starting with / (e.g. /kilimanjaro) or a full https:// address.',
        ]);

        return [
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'icon'        => $this->normaliseIcon($data['icon'] ?? null),
            'url'         => trim($data['url']),
            'badge'       => $data['badge'] ?? null,
            'badge_color' => $data['badge_color'] ?? 'secondary',
            'is_active'   => $request->boolean('is_active'),
        ];
    }

    /**
     * Accept an internal path (/kilimanjaro) or an absolute http(s) URL, and
     * nothing else — this blocks javascript: and data: URLs from reaching an
     * href in the navbar.
     */
    private function urlRule(): string
    {
        return 'regex:#^(/[^\s]*|https?://[^\s]+)$#';
    }

    /** The menu renders `fas {{ $link->icon }}`, so store the "fa-…" half only. */
    private function normaliseIcon(?string $icon): ?string
    {
        $icon = trim((string) $icon);

        if ($icon === '') {
            return null;
        }

        $icon = preg_replace('/\b(fas|far|fab|fa-solid|fa-regular|fa-brands)\b/', '', $icon);
        $icon = trim(preg_replace('/\s+/', ' ', $icon));

        if ($icon === '') {
            return null;
        }

        return str_starts_with($icon, 'fa-') ? $icon : 'fa-' . $icon;
    }

    /**
     * Move an upload into public/uploads/menu and return its relative path.
     *
     * Uses a raw stream copy rather than UploadedFile::move(). move() calls
     * is_writable() on the target directory first and throws before attempting
     * anything, and that check lies on some hosts — a directory can report
     * read-only yet accept writes perfectly well (OneDrive-synced folders on
     * Windows report 0555, for example). Copying and then verifying the file
     * actually landed is both more permissive and a stricter guarantee.
     *
     * @throws \RuntimeException when the file genuinely cannot be written
     */
    private function storeUpload($file): string
    {
        $name = 'menu_' . uniqid() . '.' . strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $dir = public_path(self::UPLOAD_DIR);

        if (! is_dir($dir) && ! @mkdir($dir, 0755, true) && ! is_dir($dir)) {
            throw new \RuntimeException('Could not create the upload folder: ' . self::UPLOAD_DIR);
        }

        $target = $dir . DIRECTORY_SEPARATOR . $name;

        $in = @fopen($file->getRealPath(), 'rb');
        if ($in === false) {
            throw new \RuntimeException('Could not read the uploaded file.');
        }

        $out = @fopen($target, 'wb');
        if ($out === false) {
            fclose($in);
            throw new \RuntimeException('Could not write to ' . self::UPLOAD_DIR . '. Check folder permissions (755).');
        }

        $copied = stream_copy_to_stream($in, $out);
        fclose($in);
        fclose($out);

        // stream_copy_to_stream returns false on failure and a byte count on
        // success — 0 is a legitimate count for an empty source, so only an
        // outright false or a missing file counts as a failed save.
        if ($copied === false || ! is_file($target)) {
            @unlink($target);
            throw new \RuntimeException('The image did not save correctly. Please try again.');
        }

        return self::UPLOAD_DIR . '/' . $name;
    }

    /**
     * Delete a previously uploaded file so replacing an image doesn't leave
     * orphans on disk. Only ever touches our own upload directory — an external
     * URL or any other path is left alone.
     */
    private function deleteUpload(?string $path): void
    {
        $path = trim((string) $path);

        if ($path === '' || ! str_starts_with($path, self::UPLOAD_DIR . '/')) {
            return;
        }

        $full = public_path($path);

        if (is_file($full)) {
            @unlink($full);
        }
    }
}
