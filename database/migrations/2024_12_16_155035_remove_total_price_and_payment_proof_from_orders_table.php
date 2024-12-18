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
        Schema::table('orders', function (Blueprint $table) {
            // Menghapus kolom total_price dan payment_proof
            $table->dropColumn(['total_price', 'payment_proof']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menambahkan kembali kolom total_price dan payment_proof jika rollback
            $table->decimal('total_price', 10, 2);
            $table->string('payment_proof', 255)->nullable();
        });
    }
};
