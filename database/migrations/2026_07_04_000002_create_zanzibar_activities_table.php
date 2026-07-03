<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zanzibar_activities', function (Blueprint $table) {
            $table->id();
            $table->string('category')->index();   // beaches, stone_town, culture, spices, turtle, marine, prison_island, jozani, packages
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();     // Font Awesome class, e.g. fa-umbrella-beach
            $table->string('image')->nullable();    // stored path on the public disk
            $table->decimal('price', 10, 2)->nullable();  // packages
            $table->string('duration')->nullable(); // e.g. "5 Days / 4 Nights"
            $table->string('best_time')->nullable();
            $table->text('details')->nullable();    // one item per line (activities / package inclusions)
            $table->unsignedInteger('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zanzibar_activities');
    }
};
