<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'ip_address')) {
                $table->string('ip_address', 45)->nullable()->after('message');
            }
            if (!Schema::hasColumn('bookings', 'user_agent')) {
                $table->string('user_agent', 255)->nullable()->after('ip_address');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['ip_address', 'user_agent']);
        });
    }
};
