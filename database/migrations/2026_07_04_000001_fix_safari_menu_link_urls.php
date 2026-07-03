<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Corrects the Safari mega-menu shortcut links, which pointed at short slugs
 * (e.g. /destinations/serengeti) that never matched the real destination
 * slugs (serengeti-national-park), causing 404s. Idempotent.
 */
return new class extends Migration
{
    private array $map = [
        '/destinations/serengeti'  => '/destinations/serengeti-national-park',
        '/destinations/ngorongoro' => '/destinations/ngorongoro-crater',
        '/destinations/tarangire'  => '/destinations/tarangire-national-park',
        '/destinations/manyara'    => '/destinations/lake-manyara',
        '/destinations/selous'     => '/destinations/selous-game-reserve',
        '/destinations/ruaha'      => '/destinations/ruaha-national-park',
    ];

    public function up(): void
    {
        if (! DB::getSchemaBuilder()->hasTable('menu_links')) {
            return;
        }

        foreach ($this->map as $old => $new) {
            DB::table('menu_links')->where('url', $old)->update(['url' => $new]);
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
    }
};
