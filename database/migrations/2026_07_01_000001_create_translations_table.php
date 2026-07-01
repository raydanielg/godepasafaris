<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Cache of machine-translated dynamic (DB) content.
 * One row per (locale, source string). Keyed by a hash of the source text
 * so lookups are O(1) and identical strings are translated only once.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 12)->index();
            $table->char('source_hash', 40); // sha1 of the source string
            $table->longText('source_text');
            $table->longText('translated_text');
            $table->timestamps();

            $table->unique(['locale', 'source_hash']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
