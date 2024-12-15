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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();  // Auto Incrementing ID column
            $table->string('image', 255);
            $table->string('link', 255)->nullable();  // Allows NULL values
            $table->date('start_date')->nullable();  // Allows NULL values
            $table->date('end_date')->nullable();  // Allows NULL values
            $table->string('start_time', 45)->nullable();  // Allows NULL values
            $table->string('end_time', 45)->nullable();  // Allows NULL values
            $table->integer('slot')->nullable();  // Allows NULL values
            $table->enum('status', ['active', 'inactive'])->nullable();  // Enum with NULL option
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
