<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Lets the admin decide, per mega-menu, whether the desktop shortcut list is
 * hand-curated (menu_links) or generated from live content.
 *
 * Background: the Safari and Destinations desktop mega menus render from
 * SafariPackage / SafariDestination, so they stay in sync automatically as new
 * packages are published. Kilimanjaro and Impact are hand-curated. Both are
 * legitimate, so rather than forcing one behaviour on all four this flag lets
 * each section choose, and defaults every section to the behaviour it has
 * today — nothing changes on screen until an admin flips it.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('menu_sections')) {
            return;
        }

        if (! Schema::hasColumn('menu_sections', 'use_custom_content')) {
            Schema::table('menu_sections', function (Blueprint $table) {
                $table->boolean('use_custom_content')->default(false)->after('is_active');
            });
        }

        // Preserve current behaviour exactly: kilimanjaro and impact already
        // render their curated links, safari and destinations render live content.
        DB::table('menu_sections')
            ->whereIn('nav_item', ['kilimanjaro', 'impact'])
            ->update(['use_custom_content' => true]);
    }

    public function down(): void
    {
        if (Schema::hasTable('menu_sections') && Schema::hasColumn('menu_sections', 'use_custom_content')) {
            Schema::table('menu_sections', function (Blueprint $table) {
                $table->dropColumn('use_custom_content');
            });
        }
    }
};
