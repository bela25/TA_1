<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoosisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promosis', function (Blueprint $table) {
            $table->increments('idpromosi');
            $table->string('judul_promosi');
            $table->string('gambar');
            $table->text('keterangan');
            $table->date('tgl_akhir');
            $table->unsignedInteger('pegawai');
            $table->foreign('pegawai')->references('nip')->on('pegawais');
            $table->unsignedInteger('lokasi');
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
        Schema::dropIfExists('promosis');
    }
}
