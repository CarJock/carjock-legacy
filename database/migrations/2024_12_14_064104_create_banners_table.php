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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();  // Auto Incrementing ID column
            $table->integer('page_id');  // Page ID
            $table->text('heading')->nullable();  // Nullable heading (text type)
            $table->longText('content')->nullable();  // Nullable content (longtext type)
            $table->string('image', 255); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
