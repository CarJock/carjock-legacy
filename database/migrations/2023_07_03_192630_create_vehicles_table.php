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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->integer('style_id');
            $table->string('fuel_type_id')->nullable();
            $table->string('engine_type_id')->nullable();
            $table->string('name');
            $table->integer('division');
            $table->integer('model');
            $table->string('style');
            $table->text('image')->nullable();
            $table->string('body_type')->nullable();
            $table->longText('data')->nullable();
            $table->string('feature')->default('no');
            $table->integer('horsepower')->nullable();
            $table->integer('torque')->nullable();
            $table->integer('pricing')->nullable();
            $table->integer('seating')->nullable();
            $table->integer('battery_range')->nullable();
            $table->integer('mpg_city')->nullable();
            $table->integer('mpg_hwy')->nullable();
            $table->integer('length_overall')->nullable();
            $table->integer('width_overall')->nullable();
            $table->integer('height_overall')->nullable();
            $table->integer('cargo_volume')->nullable();
            $table->integer('trunk_volume')->nullable();
            $table->integer('front_head_room')->nullable();
            $table->integer('front_leg_room')->nullable();
            $table->integer('second_head_room')->nullable();
            $table->integer('second_leg_room')->nullable();
            $table->integer('second_shoulder')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

