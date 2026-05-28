<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'tour_id')) {
                $table->unsignedBigInteger('tour_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('bookings', 'accommodation')) {
                $table->string('accommodation')->nullable()->after('travelers');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['tour_id', 'accommodation']);
        });
    }
};
