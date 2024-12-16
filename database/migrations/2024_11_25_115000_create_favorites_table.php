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
            $table->id(); // id_favorite sebagai string
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            
            // Menambahkan index untuk mempercepat query
            $table->index('user_id');
            $table->index('product_id');
            
            // Jika ingin menggunakan timestamps default (created_at dan updated_at)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorites');
    }
};
