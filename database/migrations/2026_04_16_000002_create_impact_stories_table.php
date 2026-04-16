<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('impact_stories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('badge'); // e.g., "Success Story", "Women Empowerment"
            $table->string('title');
            $table->text('quote');
            $table->string('image');
            $table->string('category')->default('general'); // orphan, women, rehabilitation
            $table->integer('display_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('impact_stories');
    }
};
