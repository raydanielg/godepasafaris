<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Long-form destination article + FAQs.
 *
 * `description` is rendered escaped inside a lead paragraph, so it can only ever
 * hold a short plain-text intro. The destination guides are 1,500-2,500 words
 * with comparison tables, which needs its own HTML column and its own block on
 * the page. Existing destinations keep working exactly as before — this is
 * nullable and simply not rendered when empty.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('safari_destinations')) {
            return;
        }

        Schema::table('safari_destinations', function (Blueprint $t) {
            if (! Schema::hasColumn('safari_destinations', 'article_html')) {
                $t->longText('article_html')->nullable()->after('description');
            }
            if (! Schema::hasColumn('safari_destinations', 'faqs')) {
                $t->json('faqs')->nullable()->after('article_html');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('safari_destinations')) {
            return;
        }

        Schema::table('safari_destinations', function (Blueprint $t) {
            foreach (['article_html', 'faqs'] as $col) {
                if (Schema::hasColumn('safari_destinations', $col)) {
                    $t->dropColumn($col);
                }
            }
        });
    }
};
