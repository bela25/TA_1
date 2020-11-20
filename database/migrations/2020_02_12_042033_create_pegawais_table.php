<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->increments('nip');
            $table->string('nama');
            $table->string('alamat');
            $table->date('tgl_lahir');
            $table->string('tempat_lahir');
            $table->string('no_telp');
            $table->enum('jabatan',['marketing','admin']);
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->date('tgl_bergabung');
            $table->unsignedInteger('lokasi');
            $table->foreign('lokasi')->references('idlokasi')->on('lokasis');
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users');
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
        Schema::dropIfExists('pegawais');
    }
}
