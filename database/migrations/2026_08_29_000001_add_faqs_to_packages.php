<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Per-package FAQs.
 *
 * Not one tour page on the site currently answers a question on-page, while the
 * questions travellers actually ask ("what animals will I see", "what should I
 * pack", "how do I get there") are exactly the long-tail searches these pages
 * could win. Stored as JSON [{q, a}, …] so a package carries its own answers
 * and can emit FAQPage structured data.
 */
return new class extends Migration
{
    private array $tables = ['safari_packages', 'kilimanjaro_packages'];

    public function up(): void
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table) && ! Schema::hasColumn($table, 'faqs')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->json('faqs')->nullable()->after('exclusions');
                });
            }
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'faqs')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->dropColumn('faqs');
                });
            }
        }
    }
};
