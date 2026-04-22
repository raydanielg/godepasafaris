<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packing_lists', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('category'); // kilimanjaro, safari, general
            $table->string('icon')->default('fa-suitcase');
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });

        // Items for each packing list
        Schema::create('packing_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('packing_list_id')->constrained()->onDelete('cascade');
            $table->string('item_name');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_essential')->default(false);
            $table->boolean('is_recommended')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packing_items');
        Schema::dropIfExists('packing_lists');
    }
};
