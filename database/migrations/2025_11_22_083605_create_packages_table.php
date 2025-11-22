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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Standard", "Premium"
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('system_percentage'); // Admin/system commission percentage
            $table->unsignedTinyInteger('school_percentage'); // School commission percentage
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0); // For ordering packages
            $table->json('features')->nullable(); // Optional features list
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
