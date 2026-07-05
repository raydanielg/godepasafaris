<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class BackgroundController extends Controller
{
    /**
     * The editable page backgrounds. `default` is the image shipped in the code,
     * shown as a preview until the admin uploads/sets their own.
     */
    private function items(): array
    {
        return [
            [
                'key'     => 'bg_home_1',
                'page'    => 'Home page',
                'label'   => 'Hero photo 1 (rotating banner)',
                'default' => 'images/images/3-Days-Serengeti-Balloon-Safaris.webp',
            ],
            [
                'key'     => 'bg_home_2',
                'page'    => 'Home page',
                'label'   => 'Hero photo 2 (rotating banner)',
                'default' => 'images/images/4GyurGeCrKkxo9FvCd8bnc-1000-80.jpg',
            ],
            [
                'key'     => 'bg_cultural',
                'page'    => 'Cultural Safari',
                'label'   => 'Top banner background',
                'default' => 'https://images.unsplash.com/photo-1523805009345-7448845a9e53?auto=format&fit=crop&w=1920&q=80',
            ],
            [
                'key'     => 'bg_zanzibar',
                'page'    => 'Zanzibar',
                'label'   => 'Top banner background',
                'default' => config('zanzibar.hero_image', 'https://images.unsplash.com/photo-1518684079-3c830dcef090?auto=format&fit=crop&w=1920&q=80'),
            ],
            [
                'key'     => 'bg_destinations',
                'page'    => 'Destinations',
                'label'   => 'Top banner background',
                'default' => 'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
            ],
            [
                'key'     => 'bg_safari',
                'page'    => 'Safari Packages',
                'label'   => 'Top banner background',
                'default' => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
            ],
        ];
    }

    public function index()
    {
        $items = array_map(function ($item) {
            $item['is_custom'] = SiteSetting::get($item['key']) !== null;      // admin has set something
            $item['current']   = SiteSetting::image($item['key'], $item['default']); // resolved URL for preview

            return $item;
        }, $this->items());

        return view('admin.backgrounds.index', ['items' => $items]);
    }

    public function update(Request $request)
    {
        foreach ($this->items() as $item) {
            $key = $item['key'];

            // 1) Reset back to the built-in default.
            if ($request->boolean($key . '_reset')) {
                SiteSetting::set($key, null, 'backgrounds');
                continue;
            }

            // 2) An uploaded file wins over a pasted URL.
            if ($request->hasFile($key)) {
                $request->validate(
                    [$key => 'image|mimes:jpeg,jpg,png,webp|max:8192'],
                    [$key . '.image' => 'The ' . $item['page'] . ' background must be an image (JPG, PNG or WebP).'],
                );
                SiteSetting::set($key, $this->move($request->file($key)), 'backgrounds');
                continue;
            }

            // 3) A pasted image URL.
            if ($request->filled($key . '_url')) {
                SiteSetting::set($key, trim($request->input($key . '_url')), 'backgrounds');
            }
        }

        return redirect()->route('admin.backgrounds')->with('success', 'Page backgrounds updated.');
    }

    /** Store an uploaded image into public/uploads/backgrounds and return its path. */
    private function move($file): string
    {
        $name = 'bg_' . uniqid() . '.' . strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $dir = public_path('uploads/backgrounds');
        if (! is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        $file->move($dir, $name);

        return 'uploads/backgrounds/' . $name;
    }
}
