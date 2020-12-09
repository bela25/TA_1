<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGambarProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gambar_produks', function (Blueprint $table) {
            $table->increments('id_gambarproduk');
            $table->longtext('nama_gambar');
            $table->unsignedInteger('tipe');
            $table->foreign('tipe')->references('id_tipe')->on('tipe_units');
            $table->foreign('lokasi')->references('idlokasi')->on('lokasis');
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
        Schema::dropIfExists('gambar_produks');
    }
}
