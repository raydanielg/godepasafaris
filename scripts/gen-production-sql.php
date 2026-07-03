<?php

/**
 * Generates ONE phpMyAdmin-importable SQL file for production:
 *   - creates & fills zanzibar_activities
 *   - fixes the Safari menu-link 404s
 *   - creates & fills the translations cache (so DB content translates live)
 *   - records the related migrations
 *
 * Run: php artisan tinker --execute="require 'scripts/gen-production-sql.php';"
 */

use Illuminate\Support\Facades\DB;

$q = fn ($v) => is_null($v) ? 'NULL' : "'" . str_replace(["\\", "'"], ["\\\\", "\\'"], (string) $v) . "'";

$out  = "-- Go Deep Africa Safari — production update (Zanzibar + 404 fix + translations)\n";
$out .= "-- cPanel » phpMyAdmin » select your database » SQL » paste all » Go. Safe to re-run. UTF-8.\n\n";
$out .= "SET NAMES utf8mb4;\n\n";

/* ---------------------------------------------------------------- Zanzibar */
$out .= "-- 1) Zanzibar content table\n";
$out .= "CREATE TABLE IF NOT EXISTS `zanzibar_activities` (\n"
      . "  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,\n"
      . "  `category` VARCHAR(255) NOT NULL,\n  `title` VARCHAR(255) NOT NULL,\n"
      . "  `description` TEXT NULL,\n  `icon` VARCHAR(255) NULL,\n  `image` VARCHAR(255) NULL,\n"
      . "  `price` DECIMAL(10,2) NULL,\n  `duration` VARCHAR(255) NULL,\n  `best_time` VARCHAR(255) NULL,\n"
      . "  `details` TEXT NULL,\n  `display_order` INT UNSIGNED NOT NULL DEFAULT 0,\n"
      . "  `is_active` TINYINT(1) NOT NULL DEFAULT 1,\n  `created_at` TIMESTAMP NULL,\n  `updated_at` TIMESTAMP NULL,\n"
      . "  PRIMARY KEY (`id`),\n  KEY `zanzibar_activities_category_index` (`category`)\n"
      . ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n";

$zrows = DB::table('zanzibar_activities')->orderBy('id')->get();
$out .= "DELETE FROM `zanzibar_activities`;\n";
foreach ($zrows as $r) {
    $out .= "INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ("
        . $q($r->category) . "," . $q($r->title) . "," . $q($r->description) . "," . $q($r->icon) . "," . $q($r->image) . ","
        . (is_null($r->price) ? 'NULL' : (float) $r->price) . "," . $q($r->duration) . "," . $q($r->best_time) . "," . $q($r->details) . ","
        . (int) $r->display_order . "," . (int) $r->is_active . ",NOW(),NOW());\n";
}

/* ----------------------------------------------------------- Menu 404 fix */
$out .= "\n-- 2) Fix Safari shortcut links that returned 404\n";
$map = [
    '/destinations/serengeti'  => '/destinations/serengeti-national-park',
    '/destinations/ngorongoro' => '/destinations/ngorongoro-crater',
    '/destinations/tarangire'  => '/destinations/tarangire-national-park',
    '/destinations/manyara'    => '/destinations/lake-manyara',
    '/destinations/selous'     => '/destinations/selous-game-reserve',
    '/destinations/ruaha'      => '/destinations/ruaha-national-park',
];
foreach ($map as $old => $new) {
    $out .= "UPDATE `menu_links` SET `url` = " . $q($new) . " WHERE `url` = " . $q($old) . ";\n";
}

/* -------------------------------------------------------- Translations */
$out .= "\n-- 3) Translation cache (makes package/destination content translate)\n";
$out .= "CREATE TABLE IF NOT EXISTS `translations` (\n"
      . "  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,\n"
      . "  `locale` VARCHAR(10) NOT NULL,\n  `source_hash` VARCHAR(40) NOT NULL,\n"
      . "  `source_text` TEXT NOT NULL,\n  `translated_text` TEXT NOT NULL,\n"
      . "  `created_at` TIMESTAMP NULL,\n  `updated_at` TIMESTAMP NULL,\n"
      . "  PRIMARY KEY (`id`),\n  UNIQUE KEY `translations_locale_source_hash_unique` (`locale`,`source_hash`)\n"
      . ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n";

$trows = DB::table('translations')->orderBy('id')->get();
foreach ($trows as $r) {
    $out .= "INSERT IGNORE INTO `translations` (`locale`,`source_hash`,`source_text`,`translated_text`,`created_at`,`updated_at`) VALUES ("
        . $q($r->locale) . "," . $q($r->source_hash) . "," . $q($r->source_text) . "," . $q($r->translated_text) . ",NOW(),NOW());\n";
}

/* ------------------------------------------------------- Migration records */
$out .= "\n-- 4) Mark migrations as run (keeps artisan migrate consistent)\n";
$out .= "SET @b = (SELECT COALESCE(MAX(`batch`),0)+1 FROM `migrations`);\n";
foreach ([
    '2026_07_01_000001_create_translations_table',
    '2026_07_04_000001_fix_safari_menu_link_urls',
    '2026_07_04_000002_create_zanzibar_activities_table',
] as $m) {
    $out .= "INSERT INTO `migrations` (`migration`,`batch`) SELECT " . $q($m) . ", @b FROM DUAL "
          . "WHERE NOT EXISTS (SELECT 1 FROM (SELECT `migration` FROM `migrations`) x WHERE x.`migration` = " . $q($m) . ");\n";
}

@mkdir(base_path('database/exports'), 0755, true);
file_put_contents(base_path('database/exports/production_update.sql'), $out);
echo 'Wrote database/exports/production_update.sql (' . strlen($out) . " bytes) — zanzibar={$zrows->count()}, translations={$trows->count()}\n";
