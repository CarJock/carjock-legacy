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
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();  // Auto Incrementing ID column
            $table->integer('page_id');  // Page ID (foreign key reference, if applicable)
            $table->string('short_heading', 255)->nullable();  // Nullable short heading
            $table->string('heading', 255)->nullable();  // Nullable heading
            $table->longText('content')->nullable();  // Nullable content
            $table->integer('slot')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_contents');
    }
};
