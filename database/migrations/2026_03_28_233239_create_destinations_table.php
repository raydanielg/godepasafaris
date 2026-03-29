<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->text('description');
            $table->longText('rich_content')->nullable(); // For detailed storytelling
            $table->text('weather_info')->nullable();
            $table->json('faqs')->nullable(); // Store FAQs as JSON
            $table->string('image')->nullable();
            $table->string('rate_range');
            $table->string('best_time');
            $table->string('high_season');
            $table->integer('tripadvisor_reviews')->default(2154);
            $table->float('rating')->default(5.0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
