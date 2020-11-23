<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChattingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chattings', function (Blueprint $table) {
            $table->increments('id_chat');
            $table->string('pesan');
            $table->date('tgl_pesan');
            $table->unsignedInteger('pegawai');
            $table->foreign('pegawai')->references('nip')->on('pegawais');
            $table->unsignedInteger('customer');
            $table->foreign('customer')->references('idcustomers')->on('customers');
            $table->enum('pengirim', ['pegawai','customer']);
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
        Schema::dropIfExists('chattings');
    }
}
