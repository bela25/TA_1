<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranCicilansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_cicilans', function (Blueprint $table) {
            $table->increments('id_pembayarancicilan');
            $table->date('tanggal_bayar');
            $table->integer('cicilan-ke');
            $table->double('nominal',10,2);
            $table->string('gambar_bukticicilan');
            $table->unsignedInteger('cicilan');
            $table->foreign('cicilan')->references('id_cicilan')->on('cicilans');
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
        Schema::dropIfExists('pembayaran_cicilans');
    }
}
