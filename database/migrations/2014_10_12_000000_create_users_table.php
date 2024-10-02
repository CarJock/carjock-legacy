<?php

use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('status')->default('active');
            $table->string('role')->default('user');
            $table->timestamp('email_verified_at')->nullable();
            $table->text('facebook_token')->nullable();
            $table->text('facebook_refresh_token')->nullable();
            $table->string('facebook_id')->nullable();
            $table->integer('is_subscribed')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'name' => 'Admin',
            'email' => 'admin@carjock.com',
            'role' => 'admin',
            'password' => '$2y$10$jwJsaPSzVOeZMp6goiu9wugR16gdzFfcexD5n3SXh8yzqnUZq6r4W'//Test1234!
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
