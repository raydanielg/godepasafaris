<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_sections', function (Blueprint $table) {
            $table->id();
            $table->string('nav_item'); // e.g., 'safari', 'kilimanjaro', 'impact'
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('link_url')->nullable(); // CTA button link
            $table->string('link_text')->nullable(); // CTA button text
            $table->string('badge')->nullable(); // e.g., "52 Reasons", "$100 Deposit"
            $table->string('badge_color')->default('success'); // success, warning, danger, info
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_sections');
    }
};
