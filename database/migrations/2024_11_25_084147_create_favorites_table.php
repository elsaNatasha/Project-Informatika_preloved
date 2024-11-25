<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();  // Kolom ID favorit
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Relasi dengan tabel users
            $table->foreignId('product_id')->constrained()->onDelete('cascade');  // Relasi dengan tabel products
            $table->timestamps();  // Timestamps untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
