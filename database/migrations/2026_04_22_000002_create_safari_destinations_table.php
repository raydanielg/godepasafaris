<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('safari_destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->string('location')->nullable();
            $table->string('best_time')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable();
            $table->string('icon')->default('fa-paw');
            $table->string('badge')->nullable();
            $table->string('badge_color')->default('secondary');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            
            // Highlights
            $table->string('highlight_1')->nullable();
            $table->string('highlight_2')->nullable();
            $table->string('highlight_3')->nullable();
            
            // Stats
            $table->string('area')->nullable();
            $table->string('established')->nullable();
            $table->string('wildlife_count')->nullable();
            
            $table->timestamps();
        });

        // Activities for each destination
        Schema::create('safari_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('safari_destination_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('safari_activities');
        Schema::dropIfExists('safari_destinations');
    }
};
