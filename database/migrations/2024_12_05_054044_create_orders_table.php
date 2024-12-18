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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key ke tabel users
            $table->string('name'); // Nama pelanggan
            $table->string('phone'); // Nomor telepon pelanggan
            $table->text('address'); // Alamat pelanggan
            $table->decimal('total_price', 15, 2); // Total harga pesanan
            $table->string('status')->default('pending'); // Status pesanan: pending, success, failed
            $table->timestamps(); // Created at & Updated at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
