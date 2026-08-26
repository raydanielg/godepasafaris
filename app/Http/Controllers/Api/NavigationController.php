<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MenuSection;
use Illuminate\Http\JsonResponse;

/**
 * Public, read-only navigation data for the mobile app and any other client
 * that needs the same mega-menu content the website renders.
 *
 * The website itself does NOT call this — it is a server-rendered Blade app, so
 * the navbar reads the models directly (through the same cached MenuSection::menu()
 * helper). Adding a fetch here would be a pointless round trip. This endpoint
 * exists for the external API consumers that routes/api.php already serves.
 */
class NavigationController extends Controller
{
    public function megaMenu(): JsonResponse
    {
        $categories = [];

        foreach (MenuSection::NAV_ITEMS as $navItem => $label) {
            $section = MenuSection::menu($navItem);

            // menu() already filters to active sections and active links, so
            // nothing hidden by an admin can leak out through the public API.
            if (! $section) {
                continue;
            }

            $categories[] = [
                'id'          => (string) $section->id,
                'navItem'     => $section->nav_item,
                'name'        => $label,
                'featureCard' => [
                    'title'       => $section->title,
                    'description' => $section->description,
                    'badgeText'   => $section->badge,
                    'badgeColor'  => $section->badge_color,
                    'imageUrl'    => $section->image_url,
                    'buttonText'  => $section->link_text,
                    'buttonLink'  => $section->link_url,
                ],
                'links' => $section->links->map(fn ($link) => [
                    'id'        => (string) $link->id,
                    'label'     => $link->title,
                    'subtitle'  => $link->description,
                    'icon'      => $link->icon,
                    'url'       => $link->url,
                    'badgeTag'  => $link->badge,
                    'badgeColor' => $link->badge_color,
                    'sortOrder' => $link->display_order,
                ])->values(),
            ];
        }

        return response()->json(['categories' => $categories]);
    }
}
