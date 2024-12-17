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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Foreign key ke tabel orders
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Foreign key ke tabel products
            $table->integer('quantity'); // Jumlah produk
            $table->decimal('price', 15, 2); // Harga produk
            $table->timestamps(); // Created at & Updated at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
