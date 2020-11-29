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
            $table->date('tanggal_bayar')->nullable();
            $table->integer('cicilan_ke');
            $table->bigInteger('nominal');
            $table->string('gambar_bukticicilan')->nullable();
            $table->unsignedInteger('cicilan');
            $table->date('tenggat_waktu')->nullable();
            $table->enum('cicilan_terakhir',['iya','tidak'])->nullable();
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
