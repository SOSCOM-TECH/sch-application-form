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
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropForeign(['payment_id']);
        });
        
        Schema::table('submissions', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_id')->nullable()->change();
            $table->foreign('payment_id')->references('id')->on('payments')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropForeign(['payment_id']);
        });
        
        Schema::table('submissions', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_id')->nullable(false)->change();
            $table->foreign('payment_id')->references('id')->on('payments')->cascadeOnDelete();
        });
    }
};
