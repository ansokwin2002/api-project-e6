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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_type');
            $table->string('description', 100);
            $table->string('description2', 255)->nullable();
            $table->decimal('price', 10, 2); // Item price
            $table->integer('quantity');
            $table->binary('image')->nullable(); // Stores image binary data
            $table->string('image_url', 255)->nullable(); // Recommended image path
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
