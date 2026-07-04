<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cultural_experiences', function (Blueprint $table) {
            if (! Schema::hasColumn('cultural_experiences', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('tagline');
            }
            if (! Schema::hasColumn('cultural_experiences', 'meta_description')) {
                $table->string('meta_description', 500)->nullable()->after('meta_title');
            }
        });

        Schema::create('cultural_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cultural_experience_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();   // public path
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cultural_activities');

        Schema::table('cultural_experiences', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description']);
        });
    }
};
