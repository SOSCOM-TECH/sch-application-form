<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedInteger('system_amount')->default(0)->after('net_amount');
            $table->unsignedInteger('school_amount')->default(0)->after('system_amount');
        });

        DB::statement('UPDATE payments SET system_amount = commission_amount, school_amount = net_amount');
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['system_amount', 'school_amount']);
        });
    }
};


