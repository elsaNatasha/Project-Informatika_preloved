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
    Schema::create('products', function (Blueprint $table) {
        $table->id();  // Kolom id sebagai primary key untuk tabel produk
        $table->string('productname');
        $table->foreignId('cat_id')->constrained('categories'); // Relasi ke tabel categories
        $table->text('description');
        $table->decimal('price', 8, 2);
        $table->string('photo');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
