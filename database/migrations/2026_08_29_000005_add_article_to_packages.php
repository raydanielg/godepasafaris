<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Long-form article body for tour packages.
 *
 * The tour write-ups carry comparison tables (park highlights, best time to
 * visit, accommodation tiers) that the itinerary array cannot hold — it only
 * stores day / title / description. Nullable, and only rendered when present,
 * so every existing package page is unchanged.
 */
return new class extends Migration
{
    private array $tables = ['safari_packages', 'kilimanjaro_packages'];

    public function up(): void
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table) && ! Schema::hasColumn($table, 'article_html')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->longText('article_html')->nullable()->after('description');
                });
            }
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'article_html')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->dropColumn('article_html');
                });
            }
        }
    }
};
