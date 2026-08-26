<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Repairs mega-menu shortcut links that pointed at URLs with no matching route
 * or record. Same class of bug as 2026_07_04_000001_fix_safari_menu_link_urls,
 * but for the Kilimanjaro and Destinations sections.
 *
 * These were live on the MOBILE sidebar (which renders menu_links directly), so
 * real visitors and Googlebot were hitting 404s:
 *
 *   /kilimanjaro/pricing    -> fell through to /kilimanjaro/{slug}; no such
 *                              package slug, so 404. Real page: /private-tours
 *   /kilimanjaro/group      -> 404. Real page: /kilimanjaro/group-departures
 *   /kilimanjaro/calculator -> 404. Real page: /kilimanjaro/success-calculator
 *   /destinations/meru      -> no "meru" destination record exists at all.
 *                              Mount Meru is covered by /kilimanjaro/other-mountains,
 *                              so the link is repointed there instead of dropped —
 *                              it keeps a useful nav entry and kills the 404.
 *
 * Two more were not 404s but pointed at the wrong page; corrected so the menu
 * matches the labels ("Kilimanjaro Routes" went to the overview, not /routes).
 *
 * Idempotent and guarded, so it is safe to re-run and safe on a fresh install
 * where the table does not exist yet.
 */
return new class extends Migration
{
    private array $map = [
        '/kilimanjaro/pricing'    => '/kilimanjaro/private-tours',
        '/kilimanjaro/group'      => '/kilimanjaro/group-departures',
        '/kilimanjaro/calculator' => '/kilimanjaro/success-calculator',
        '/destinations/meru'      => '/kilimanjaro/other-mountains',
    ];

    /** Wrong destination rather than a 404 — matched on title so we only touch the intended row. */
    private array $retarget = [
        'Kilimanjaro Routes' => ['/kilimanjaro'                => '/kilimanjaro/routes'],
        'Packing List'       => ['/packing-list'               => '/kilimanjaro/packing-list'],
        'Helpful Articles'   => ['/blog?category=kilimanjaro'  => '/kilimanjaro/articles'],
    ];

    public function up(): void
    {
        if (! DB::getSchemaBuilder()->hasTable('menu_links')) {
            return;
        }

        foreach ($this->map as $old => $new) {
            DB::table('menu_links')->where('url', $old)->update(['url' => $new]);
        }

        foreach ($this->retarget as $title => $urls) {
            foreach ($urls as $old => $new) {
                DB::table('menu_links')->where('title', $title)->where('url', $old)->update(['url' => $new]);
            }
        }

        // The desktop menu used fa-user for "Private Tours and Pricing" while the
        // database said fa-tag. Align the database with what is on screen today.
        DB::table('menu_links')
            ->where('title', 'Private Tours and Pricing')
            ->update(['icon' => 'fa-user']);

        // Three badge colours also disagreed with the hardcoded desktop markup
        // that is actually being rendered. Now that the menu reads from the
        // database, adopt the on-screen colours so nothing changes visually.
        $badgeColors = [
            'Group Departures'   => 'warning', // was success in the DB
            'Packing List'       => 'info',    // was danger
            'Success Calculator' => 'danger',  // was info
        ];

        foreach ($badgeColors as $title => $color) {
            DB::table('menu_links')->where('title', $title)->update(['badge_color' => $color]);
        }
    }

    public function down(): void
    {
        if (! DB::getSchemaBuilder()->hasTable('menu_links')) {
            return;
        }

        foreach ($this->map as $old => $new) {
            DB::table('menu_links')->where('url', $new)->update(['url' => $old]);
        }

        foreach ($this->retarget as $title => $urls) {
            foreach ($urls as $old => $new) {
                DB::table('menu_links')->where('title', $title)->where('url', $new)->update(['url' => $old]);
            }
        }
    }
};
