<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

/**
 * Testimonial manager.
 *
 * Staff enter real customer feedback here and upload the customer's own photo.
 * Nothing is generated, and there are no defaults: an empty list means the site
 * shows no testimonials, which is the correct state until real ones exist.
 *
 * Uploads follow the same route as page backgrounds and mega-menu images —
 * moved into public/uploads/… and stored as a relative path — because the
 * cPanel storage symlink is not reliable on this host.
 */
class TestimonialController extends Controller
{
    private const UPLOAD_DIR = 'uploads/testimonials';

    public function index()
    {
        return view('admin.testimonials.index', [
            'testimonials' => Testimonial::orderByDesc('is_featured')
                ->orderBy('display_order')
                ->orderByDesc('id')
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['display_order'] = (int) Testimonial::max('display_order') + 1;

        if ($request->hasFile('photo')) {
            try {
                $data['image'] = $this->storeUpload($request->file('photo'));
            } catch (\Throwable $e) {
                return back()->withInput()->withErrors(['photo' => $e->getMessage()]);
            }
        } elseif ($request->filled('image_url')) {
            $data['image'] = trim($request->input('image_url'));
        }

        Testimonial::create($data);

        return back()->with('success', 'Testimonial added.');
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $this->validated($request);

        if ($request->boolean('remove_photo')) {
            $this->deleteUpload($testimonial->image);
            $data['image'] = null;
        } elseif ($request->hasFile('photo')) {
            $old = $testimonial->image;
            try {
                $data['image'] = $this->storeUpload($request->file('photo'));
            } catch (\Throwable $e) {
                return back()->withInput()->withErrors(['photo' => $e->getMessage()]);
            }
            $this->deleteUpload($old);
        } elseif ($request->filled('image_url')) {
            $this->deleteUpload($testimonial->image);
            $data['image'] = trim($request->input('image_url'));
        }

        $testimonial->update($data);

        return back()->with('success', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $this->deleteUpload($testimonial->image);
        $testimonial->delete();

        return back()->with('success', 'Testimonial deleted.');
    }

    /** Hide from the website without losing the record. */
    public function toggle(Testimonial $testimonial)
    {
        $testimonial->update(['is_active' => ! $testimonial->is_active]);

        return back()->with('success', $testimonial->is_active
            ? 'Testimonial is now visible on the website.'
            : 'Testimonial hidden (not deleted).');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name'         => ['required', 'string', 'max:120'],
            'location'     => ['nullable', 'string', 'max:120'],
            'content'      => ['required', 'string', 'min:10', 'max:1500'],
            'rating'       => ['required', 'integer', 'min:1', 'max:5'],
            'trip'         => ['nullable', 'string', 'max:160'],
            'travelled_on' => ['nullable', 'date', 'before_or_equal:today'],
            'is_featured'  => ['nullable', 'boolean'],
            'is_active'    => ['nullable', 'boolean'],
            'photo'        => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
            'image_url'    => ['nullable', 'string', 'max:2048', 'regex:#^https?://[^\s]+$#'],
        ], [
            'content.min'    => 'Please paste the customer\'s actual words — at least a sentence.',
            'photo.image'    => 'The photo must be a JPG, PNG or WebP file.',
            'photo.max'      => 'The photo must be 4 MB or smaller.',
            'image_url.regex'=> 'The photo link must start with https://',
            'travelled_on.before_or_equal' => 'The travel date cannot be in the future.',
        ]);

        return [
            'name'         => $data['name'],
            'location'     => $data['location'] ?? null,
            'content'      => trim(strip_tags($data['content'])),
            'rating'       => $data['rating'],
            'trip'         => $data['trip'] ?? null,
            'travelled_on' => $data['travelled_on'] ?? null,
            'is_featured'  => $request->boolean('is_featured'),
            'is_active'    => $request->boolean('is_active'),
        ];
    }

    /**
     * Verified stream copy rather than UploadedFile::move(): move() pre-checks
     * is_writable() and aborts, and that check reports false on some hosts
     * (OneDrive-synced folders on Windows) where writing actually succeeds.
     */
    private function storeUpload($file): string
    {
        $name = 'tst_' . uniqid() . '.' . strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $dir  = public_path(self::UPLOAD_DIR);

        if (! is_dir($dir) && ! @mkdir($dir, 0755, true) && ! is_dir($dir)) {
            throw new \RuntimeException('Could not create the upload folder: ' . self::UPLOAD_DIR);
        }

        $target = $dir . DIRECTORY_SEPARATOR . $name;

        $in = @fopen($file->getRealPath(), 'rb');
        if ($in === false) {
            throw new \RuntimeException('Could not read the uploaded photo.');
        }

        $out = @fopen($target, 'wb');
        if ($out === false) {
            fclose($in);
            throw new \RuntimeException('Could not write to ' . self::UPLOAD_DIR . '. Check folder permissions (755).');
        }

        $copied = stream_copy_to_stream($in, $out);
        fclose($in);
        fclose($out);

        if ($copied === false || ! is_file($target)) {
            @unlink($target);
            throw new \RuntimeException('The photo did not save correctly. Please try again.');
        }

        return self::UPLOAD_DIR . '/' . $name;
    }

    /** Only ever removes files from our own upload folder. */
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
