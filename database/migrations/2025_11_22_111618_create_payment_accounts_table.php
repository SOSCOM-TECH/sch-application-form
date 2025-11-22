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
        Schema::create('payment_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // 'bank' or 'mobile'
            $table->string('provider')->nullable(); // CRDB, NMB, NBC, mpesa, tigopesa, airtel_money, halo_pesa
            $table->string('account_number')->nullable(); // For bank accounts
            $table->string('account_name'); // Account holder name
            $table->string('phone_number')->nullable(); // For mobile accounts (07 or 06, 10 digits)
            $table->string('mobile_name')->nullable(); // Name for mobile account
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_accounts');
    }
};
