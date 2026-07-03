<?php

/**
 * Generates a phpMyAdmin-importable SQL file for production: creates the
 * zanzibar_activities table, loads its rows from the local DB, applies the
 * Safari menu-link 404 fix, and records the migrations. Run via:
 *   php artisan tinker --execute="require 'scripts/gen-zanzibar-sql.php';"
 */

use Illuminate\Support\Facades\DB;

$q = fn ($v) => is_null($v) ? 'NULL' : "'" . str_replace(["\\", "'"], ["\\\\", "\\'"], (string) $v) . "'";

$out  = "-- Go Deep Africa Safari — Zanzibar content + Safari menu-link fix\n";
$out .= "-- Import via cPanel » phpMyAdmin » (select your database) » SQL tab » paste » Go.\n";
$out .= "-- Safe to run once. UTF-8.\n\n";
$out .= "SET NAMES utf8mb4;\n\n";

// 1) Table
$out .= "CREATE TABLE IF NOT EXISTS `zanzibar_activities` (\n"
      . "  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,\n"
      . "  `category` VARCHAR(255) NOT NULL,\n"
      . "  `title` VARCHAR(255) NOT NULL,\n"
      . "  `description` TEXT NULL,\n"
      . "  `icon` VARCHAR(255) NULL,\n"
      . "  `image` VARCHAR(255) NULL,\n"
      . "  `price` DECIMAL(10,2) NULL,\n"
      . "  `duration` VARCHAR(255) NULL,\n"
      . "  `best_time` VARCHAR(255) NULL,\n"
      . "  `details` TEXT NULL,\n"
      . "  `display_order` INT UNSIGNED NOT NULL DEFAULT 0,\n"
      . "  `is_active` TINYINT(1) NOT NULL DEFAULT 1,\n"
      . "  `created_at` TIMESTAMP NULL,\n"
      . "  `updated_at` TIMESTAMP NULL,\n"
      . "  PRIMARY KEY (`id`),\n"
      . "  KEY `zanzibar_activities_category_index` (`category`)\n"
      . ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n";

// 2) Data (reset then insert so it is repeatable)
$rows = DB::table('zanzibar_activities')->orderBy('id')->get();
$out .= "DELETE FROM `zanzibar_activities`;\n";
foreach ($rows as $r) {
    $out .= "INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ("
        . $q($r->category) . "," . $q($r->title) . "," . $q($r->description) . "," . $q($r->icon) . "," . $q($r->image) . ","
        . (is_null($r->price) ? 'NULL' : (float) $r->price) . "," . $q($r->duration) . "," . $q($r->best_time) . "," . $q($r->details) . ","
        . (int) $r->display_order . "," . (int) $r->is_active . ",NOW(),NOW());\n";
}
$out .= "\n";

// 3) Safari shortcut 404 fix
$map = [
    '/destinations/serengeti'  => '/destinations/serengeti-national-park',
    '/destinations/ngorongoro' => '/destinations/ngorongoro-crater',
    '/destinations/tarangire'  => '/destinations/tarangire-national-park',
    '/destinations/manyara'    => '/destinations/lake-manyara',
    '/destinations/selous'     => '/destinations/selous-game-reserve',
    '/destinations/ruaha'      => '/destinations/ruaha-national-park',
];
$out .= "-- Fix Safari shortcut links that returned 404\n";
foreach ($map as $old => $new) {
    $out .= "UPDATE `menu_links` SET `url` = " . $q($new) . " WHERE `url` = " . $q($old) . ";\n";
}
$out .= "\n";

// 4) Record migrations so a future `php artisan migrate` won't re-run them
$out .= "-- Mark these migrations as run (keeps artisan migrate consistent)\n";
$out .= "SET @b = (SELECT COALESCE(MAX(`batch`),0)+1 FROM `migrations`);\n";
foreach ([
    '2026_07_04_000001_fix_safari_menu_link_urls',
    '2026_07_04_000002_create_zanzibar_activities_table',
] as $m) {
    $out .= "INSERT INTO `migrations` (`migration`,`batch`) SELECT " . $q($m) . ", @b FROM DUAL "
          . "WHERE NOT EXISTS (SELECT 1 FROM (SELECT `migration` FROM `migrations`) x WHERE x.`migration` = " . $q($m) . ");\n";
}

@mkdir(base_path('database/exports'), 0755, true);
file_put_contents(base_path('database/exports/zanzibar_production.sql'), $out);
echo 'Wrote database/exports/zanzibar_production.sql (' . strlen($out) . " bytes, {$rows->count()} items)\n";
