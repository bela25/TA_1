<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpesifikasiBangunansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spesifikasi_bangunans', function (Blueprint $table) {
            $table->increments('idspesifikasi');
            $table->string('lantai');
            $table->string('dinding');
            $table->string('platfon');
            $table->string('instalasi_listrik');
            $table->string('sanitary');
            $table->string('pintu');
            $table->string('jendela');
            $table->string('air');
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
        Schema::dropIfExists('spesifikasi_bangunans');
    }
}
