<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTransactionsTable extends Migration
{
    public function up()
{
    Schema::table('transactions', function (Blueprint $table) {
        // Hanya menambah kolom payment_proof
        $table->string('payment_proof')->nullable()->after('order_id');

        // Menambahkan foreign key jika belum ada
        $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('transactions', function (Blueprint $table) {
        // Menghapus kolom payment_proof
        $table->dropColumn('payment_proof');
        
        // Menghapus foreign key jika ada
        $table->dropForeign(['order_id']);
    });
}


}
