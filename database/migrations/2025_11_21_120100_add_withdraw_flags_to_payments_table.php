<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->boolean('system_withdrawn')->default(false)->after('system_amount');
            $table->boolean('school_withdrawn')->default(false)->after('school_amount');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['system_withdrawn', 'school_withdrawn']);
        });
    }
};


