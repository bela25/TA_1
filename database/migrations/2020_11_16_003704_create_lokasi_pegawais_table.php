<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLokasiPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasi_pegawais', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lokasi');
            $table->foreign('lokasi')->references('idlokasi')->on('lokasis');
            $table->unsignedInteger('pegawai');
            $table->foreign('pegawai')->references('nip')->on('pegawais');
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
        Schema::dropIfExists('lokasi_pegawais');
    }
}
