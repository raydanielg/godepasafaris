<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cultural_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('region')->nullable();      // e.g. Arusha, Lake Eyasi
            $table->string('tribe')->nullable();       // e.g. Maasai (grouping/category)
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->text('highlights')->nullable();    // one per line
            $table->text('activities')->nullable();    // one per line
            $table->decimal('price', 10, 2)->nullable();
            $table->string('duration')->nullable();    // e.g. Half day, 2 days
            $table->string('best_time')->nullable();
            $table->string('image')->nullable();       // main / banner image (public path)
            $table->json('gallery')->nullable();       // array of public image paths
            $table->string('icon')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();
        });

        Schema::create('cultural_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cultural_experience_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('location')->nullable();    // reviewer country/city
            $table->unsignedTinyInteger('rating')->default(5);
            $table->text('comment');
            $table->boolean('is_approved')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cultural_reviews');
        Schema::dropIfExists('cultural_experiences');
    }
};
