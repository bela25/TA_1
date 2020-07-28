<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHargaJualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harga_juals', function (Blueprint $table) {
            $table->increments('idhargajual');
            $table->date('tgl_awal');
            $table->double('hargajual_cash',10,0);
            $table->date('tgl_akhir');
            $table->unsignedInteger('tower');
            $table->foreign('tower')->references('id_tower')->on('towers');
            $table->unsignedInteger('arah');
            $table->foreign('arah')->references('id_arah')->on('arah_units');
            $table->unsignedInteger('tipe');
            $table->foreign('tipe')->references('id_tipe')->on('tipe_units');
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
        Schema::dropIfExists('harga_juals');
    }
}
