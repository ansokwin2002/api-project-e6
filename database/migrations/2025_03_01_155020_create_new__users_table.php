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
        Schema::create('new__users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique();
            $table->string('role', 50); // User role/permission
            $table->string('email', 100)->unique();
            $table->string('password_hash', 255); // Hashed password
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new__users');
    }
};
