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
        Schema::create('cart_page', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('new__users')->onDelete('cascade'); // Reference to users(id)
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade'); // Reference to items(id)
            $table->integer('quantity');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_pages');
    }
};
