<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCicilansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cicilans', function (Blueprint $table) {
            $table->increments('id_cicilan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->unsignedInteger('transaksi');
            $table->foreign('transaksi')->references('id_transaksi')->on('transaksis');
            $table->decimal('bunga',3,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cicilans');
    }
}
