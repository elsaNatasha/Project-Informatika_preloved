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
        Schema::create('mix_match_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('top_id');
            $table->foreignId('bottom_id');
            $table->timestamps();

            $table->foreign('top_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('bottom_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mix_match_recommendations');
    }
};
