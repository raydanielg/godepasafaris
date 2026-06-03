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
        Schema::table('safari_packages', function (Blueprint $table) {
            if (!Schema::hasColumn('safari_packages', 'description')) {
                $table->text('description')->nullable()->after('summary');
            }
            if (!Schema::hasColumn('safari_packages', 'currency')) {
                $table->string('currency', 10)->default('USD')->after('price');
            }
            if (!Schema::hasColumn('safari_packages', 'group_discount')) {
                $table->decimal('group_discount', 5, 2)->nullable()->after('days');
            }
            if (!Schema::hasColumn('safari_packages', 'min_group_size')) {
                $table->integer('min_group_size')->nullable()->after('group_discount');
            }
            if (!Schema::hasColumn('safari_packages', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('category');
            }
            if (!Schema::hasColumn('safari_packages', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('is_featured');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('safari_packages', function (Blueprint $table) {
            $table->dropColumn(['description', 'currency', 'group_discount', 'min_group_size', 'is_featured', 'is_active']);
        });
    }
};
