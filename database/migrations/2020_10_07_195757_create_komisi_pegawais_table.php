<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKomisiPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komisi_pegawais', function (Blueprint $table) {
            $table->increments('idkomisi_pegawai');
            $table->double('bonus');
            $table->unsignedInteger('transaksi');
            $table->foreign('transaksi')->references('id_transaksi')->on('transaksis');
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
        Schema::dropIfExists('komisi_pegawais');
    }
}
