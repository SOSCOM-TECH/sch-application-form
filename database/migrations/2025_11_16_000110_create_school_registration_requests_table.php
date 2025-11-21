<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_registration_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // representative
            $table->string('school_name');
            $table->string('school_type')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('address')->nullable();
            $table->json('proof_documents')->nullable(); // store array of paths
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->text('rejection_reason')->nullable();
            $table->integer('commission_rate')->default(15);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_registration_requests');
    }
};


