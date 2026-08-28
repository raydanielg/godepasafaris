<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Replaces the estimated tour prices with the client's own stated prices.
 *
 * The imported tours were first priced from published 2026 rates at Safari
 * Soles and Altezza, because the visible part of the source documents carried
 * no prices. The prices were in fact there — inside the internal "Tour
 * Snapshot" and "Price Section" blocks that are stripped before publication.
 *
 * Only the advertised selling price ("From $…") is used. Cost and margin
 * figures were read solely to identify the columns and are stored nowhere.
 *
 * The estimates were badly wrong on the fly-in wilderness trips, where charter
 * flights dominate the cost and a per-day model does not work:
 *
 *   Mahale chimpanzee safari    estimated $2,000  ->  actual  $5,950
 *   Katavi / Mahale / Tanganyika estimated $4,000 ->  actual $10,950
 *
 * Matched on exact slug only. Two documents describe already-published tours
 * and are deliberately not in this list, so no existing package is repriced.
 */
return new class extends Migration
{
    /** slug => advertised "from" price, USD. */
    private array $prices = [
        '10-day-katavi-mahale-and-lake-tanganyika-safari'                       => 10950,
        '8-day-katavi-and-mahale-luxury-safari'                                 => 8500,
        '14-day-great-migration-and-zanzibar-luxury-safari'                     => 7837,
        '10-day-nyerere-ruaha-and-zanzibar-safari'                              => 6250,
        '6-day-katavi-fly-in-wilderness-safari'                                 => 6250,
        '5-day-mahale-mountains-chimpanzee-safari'                              => 5950,
        '14-day-great-migration-and-zanzibar-mid-range-safari'                  => 5141,
        '7-day-nyerere-and-ruaha-fly-in-safari'                                 => 4750,
        '9-day-serengeti-ngorongoro-tarangire-kilimanjaro'                      => 4500,
        '10-day-great-migration-culture-and-lake-natron-safari'                 => 4308,
        '5-day-rubondo-island-lake-victoria-safari'                             => 3850,
        '7-day-calving-season-safari'                                           => 3222,
        '4-day-fly-in-drive-out-serengeti-and-ngorongoro-safari-from-zanzibar'  => 2814,
        '6-day-nyerere-and-mikumi-southern-tanzania-safari'                     => 2625,
        '6-day-tanzania-wildlife-safari'                                        => 2455,
        '4-day-classic-tanzania-safari'                                         => 1899,
        '5-day-mikumi-and-udzungwa-mountains-safari'                            => 1688,
        '4-day-nyerere-national-park-safari-with-boat-safari'                   => 1563,
        '3-day-nyerere-national-park-safari-from-dar-es-salaam'                 => 1312,
    ];

    public function up(): void
    {
        foreach (['safari_packages', 'kilimanjaro_packages'] as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            foreach ($this->prices as $slug => $price) {
                DB::table($table)->where('slug', $slug)->update([
                    'price'      => $price,
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        // Not reversible: the previous values were guesses, and restoring a
        // $2,000 price on a $5,950 tour would be worse than leaving it correct.
    }
};
