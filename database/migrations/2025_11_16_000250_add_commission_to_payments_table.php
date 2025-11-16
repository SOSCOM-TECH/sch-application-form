<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedTinyInteger('commission_rate')->default(15)->after('amount'); // percent
            $table->unsignedInteger('commission_amount')->default(0)->after('commission_rate');
            $table->unsignedInteger('net_amount')->default(0)->after('commission_amount');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['commission_rate', 'commission_amount', 'net_amount']);
        });
    }
};


