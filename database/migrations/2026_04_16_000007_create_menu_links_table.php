<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_section_id')->constrained('menu_sections')->onDelete('cascade');
            $table->string('title');
            $table->string('url');
            $table->string('icon')->nullable(); // FontAwesome icon
            $table->string('badge')->nullable(); // e.g., "Free PDF", "New"
            $table->string('badge_color')->default('secondary');
            $table->text('description')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_links');
    }
};
