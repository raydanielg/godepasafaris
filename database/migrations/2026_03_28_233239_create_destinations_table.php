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
            $table->string('category'); // National Parks, Mountains, etc.
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('rate_range'); // e.g., "$120 to $2820"
            $table->string('best_time'); // e.g., "June to October"
            $table->string('high_season'); // e.g., "July to October"
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
