<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            // Membuat id_favorite sebagai primary key
            $table->string('id_favorite')->primary(); // id_favorite sebagai string
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps(0);  // Menggunakan timestamps dengan format tanpa 'updated_at'
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorites');
    }
};
