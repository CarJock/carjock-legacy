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
        
            $table->integer('style_id');  // Style ID
            $table->integer('style_number')->nullable();  // Nullable style number
            $table->string('fuel_type_id', 255)->nullable();  // Nullable fuel type
            $table->string('engine_type_id', 255)->nullable();  // Nullable engine type
            $table->string('name', 255);  // Name of the vehicle
            $table->integer('year')->nullable();  // Nullable year
            $table->text('image')->nullable();  // Nullable image
            $table->string('body_type', 255)->nullable();  // Nullable body type
            $table->integer('horsepower')->nullable();  // Nullable horsepower
            $table->integer('torque')->nullable();  // Nullable torque
            $table->integer('pricing')->nullable();  // Nullable pricing
            $table->integer('seating')->nullable();  // Nullable seating capacity
            $table->integer('battery_range')->nullable();  // Nullable battery range
            $table->integer('mpg_city')->nullable();  // Nullable city MPG
            $table->integer('mpg_hwy')->nullable();  // Nullable highway MPG
            $table->integer('length_overall')->nullable();  // Nullable overall length
            $table->decimal('width_overall', 20, 2)->nullable();  // Nullable overall width
            $table->integer('height_overall')->nullable();  // Nullable overall height
            $table->integer('cargo_volume')->nullable();  // Nullable cargo volume
            $table->decimal('cargo_volume_to_seat_1', 20, 6)->nullable();  // Nullable cargo volume to seat 1
            $table->decimal('trunk_volume', 20, 2)->nullable();  // Nullable trunk volume
            $table->integer('front_head_room')->nullable();  // Nullable front headroom
            $table->integer('front_shoulder_room')->nullable();  // Nullable front shoulder room
            $table->integer('front_leg_room')->nullable();  // Nullable front legroom
            $table->integer('second_head_room')->nullable();  // Nullable second-row headroom
            $table->integer('second_leg_room')->nullable();  // Nullable second-row legroom
            $table->integer('second_shoulder_room')->nullable();  // Nullable second-row shoulder room
            $table->string('division', 255)->nullable();  // Nullable division
            $table->string('model', 255)->nullable();  // Nullable model
            $table->string('style', 255)->nullable();  // Nullable style
            $table->longText('data')->nullable();  // Nullable long text data
            $table->string('link_url', 2000)->nullable();  // Nullable link URL
            $table->string('feature', 255)->default('no');  // Feature with default 'no'
            $table->tinyInteger('garage')->default(0);  // Garage with default 0
            $table->timestamps();  // created_at and updated_at timestamps
            $table->softDeletes('deleted_at', 0);  // Soft delete column
            $table->longText('tech_specs')->nullable();  // Nullable tech specs
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
