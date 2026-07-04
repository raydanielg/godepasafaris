<?php

/**
 * Generates a phpMyAdmin-importable SQL file for the Cultural Safari section:
 * creates & fills cultural_experiences + cultural_reviews and records the
 * migration. Run:
 *   php artisan tinker --execute="require 'scripts/gen-cultural-sql.php';"
 */

use Illuminate\Support\Facades\DB;

$q = fn ($v) => is_null($v) ? 'NULL' : "'" . str_replace(["\\", "'"], ["\\\\", "\\'"], (string) $v) . "'";
$n = fn ($v) => is_null($v) ? 'NULL' : (is_numeric($v) ? $v : $q($v));

$out  = "-- Go Deep Africa Safari — Cultural Safari section\n";
$out .= "-- cPanel » phpMyAdmin » select your database » SQL » paste all » Go. Safe to re-run. UTF-8.\n\n";
$out .= "SET NAMES utf8mb4;\nSET FOREIGN_KEY_CHECKS=0;\n\n";

/* Tables */
$out .= "CREATE TABLE IF NOT EXISTS `cultural_experiences` (\n"
      . "  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,\n  `name` VARCHAR(255) NOT NULL,\n  `slug` VARCHAR(255) NOT NULL,\n"
      . "  `region` VARCHAR(255) NULL,\n  `tribe` VARCHAR(255) NULL,\n  `tagline` VARCHAR(255) NULL,\n"
      . "  `description` TEXT NULL,\n  `highlights` TEXT NULL,\n  `activities` TEXT NULL,\n"
      . "  `price` DECIMAL(10,2) NULL,\n  `duration` VARCHAR(255) NULL,\n  `best_time` VARCHAR(255) NULL,\n"
      . "  `image` VARCHAR(255) NULL,\n  `gallery` JSON NULL,\n  `icon` VARCHAR(255) NULL,\n"
      . "  `is_featured` TINYINT(1) NOT NULL DEFAULT 0,\n  `is_active` TINYINT(1) NOT NULL DEFAULT 1,\n"
      . "  `display_order` INT UNSIGNED NOT NULL DEFAULT 0,\n  `created_at` TIMESTAMP NULL,\n  `updated_at` TIMESTAMP NULL,\n"
      . "  PRIMARY KEY (`id`),\n  UNIQUE KEY `cultural_experiences_slug_unique` (`slug`)\n"
      . ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n";

$out .= "CREATE TABLE IF NOT EXISTS `cultural_reviews` (\n"
      . "  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,\n  `cultural_experience_id` BIGINT UNSIGNED NOT NULL,\n"
      . "  `name` VARCHAR(255) NOT NULL,\n  `location` VARCHAR(255) NULL,\n  `rating` TINYINT UNSIGNED NOT NULL DEFAULT 5,\n"
      . "  `comment` TEXT NOT NULL,\n  `is_approved` TINYINT(1) NOT NULL DEFAULT 1,\n"
      . "  `created_at` TIMESTAMP NULL,\n  `updated_at` TIMESTAMP NULL,\n"
      . "  PRIMARY KEY (`id`),\n  KEY `cultural_reviews_exp_idx` (`cultural_experience_id`)\n"
      . ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n";

/* Data */
$out .= "DELETE FROM `cultural_reviews`;\nDELETE FROM `cultural_experiences`;\n\n";

foreach (DB::table('cultural_experiences')->orderBy('id')->get() as $e) {
    $out .= "INSERT INTO `cultural_experiences` (`id`,`name`,`slug`,`region`,`tribe`,`tagline`,`description`,`highlights`,`activities`,`price`,`duration`,`best_time`,`image`,`gallery`,`icon`,`is_featured`,`is_active`,`display_order`,`created_at`,`updated_at`) VALUES ("
        . (int) $e->id . "," . $q($e->name) . "," . $q($e->slug) . "," . $q($e->region) . "," . $q($e->tribe) . "," . $q($e->tagline) . ","
        . $q($e->description) . "," . $q($e->highlights) . "," . $q($e->activities) . "," . $n($e->price) . "," . $q($e->duration) . "," . $q($e->best_time) . ","
        . $q($e->image) . "," . $q($e->gallery) . "," . $q($e->icon) . "," . (int) $e->is_featured . "," . (int) $e->is_active . "," . (int) $e->display_order . ",NOW(),NOW());\n";
}
$out .= "\n";
foreach (DB::table('cultural_reviews')->orderBy('id')->get() as $r) {
    $out .= "INSERT INTO `cultural_reviews` (`id`,`cultural_experience_id`,`name`,`location`,`rating`,`comment`,`is_approved`,`created_at`,`updated_at`) VALUES ("
        . (int) $r->id . "," . (int) $r->cultural_experience_id . "," . $q($r->name) . "," . $q($r->location) . "," . (int) $r->rating . "," . $q($r->comment) . "," . (int) $r->is_approved . ",NOW(),NOW());\n";
}

/* Migration record */
$out .= "\nSET FOREIGN_KEY_CHECKS=1;\n\n";
$out .= "SET @b = (SELECT COALESCE(MAX(`batch`),0)+1 FROM `migrations`);\n";
$out .= "INSERT INTO `migrations` (`migration`,`batch`) SELECT '2026_07_04_000003_create_cultural_experiences_tables', @b FROM DUAL "
      . "WHERE NOT EXISTS (SELECT 1 FROM (SELECT `migration` FROM `migrations`) x WHERE x.`migration` = '2026_07_04_000003_create_cultural_experiences_tables');\n";

@mkdir(base_path('database/exports'), 0755, true);
file_put_contents(base_path('database/exports/cultural_update.sql'), $out);
echo 'Wrote database/exports/cultural_update.sql (' . strlen($out) . ' bytes) — experiences=' . DB::table('cultural_experiences')->count() . ', reviews=' . DB::table('cultural_reviews')->count() . "\n";
