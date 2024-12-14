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
        // Schema::create('favorites', function (Blueprint $table) {
        //     $table->string('id_favorite')->primary(); // Primary key adalah id_favorite
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Schema::dropIfExists('favorites');
    }
};