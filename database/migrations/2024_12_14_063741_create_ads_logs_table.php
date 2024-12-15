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
        Schema::create('ads_logs', function (Blueprint $table) {
            $table->id();  // Auto Incrementing ID column
            $table->integer('page_id')->nullable();  // Allows NULL values
            $table->enum('type', ['view', 'click'])->nullable();  // Enum with NULL option
            $table->integer('slot')->nullable();  // Allows NULL values
     // created_at and updated_at with default timestamps

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads_logs');
    }
};
