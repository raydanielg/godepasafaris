<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Real, admin-managed customer testimonials.
 *
 * These were previously a hardcoded array of 21 invented reviewers in
 * WelcomeController, every one of them 5 stars, illustrated with AI-generated
 * faces from i.pravatar.cc. Presenting invented reviews as genuine is a
 * consumer-protection problem in our main markets (UK and US) before it is an
 * SEO one, so the content now has to come from here — entered by staff from
 * real, consent-given feedback.
 *
 * The table ships EMPTY on purpose. The site shows no testimonial section at
 * all until real ones are added, which is the correct state to be in.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();     // "United Kingdom"
            $table->text('content');
            $table->unsignedTinyInteger('rating')->default(5);
            $table->string('image')->nullable();         // upload path or external URL
            $table->string('trip')->nullable();          // which safari/trek they took
            $table->date('travelled_on')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'display_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
