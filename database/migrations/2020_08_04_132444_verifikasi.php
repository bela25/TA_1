<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Verifikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifikasis', function (Blueprint $table) {
            $table->increments('idverifikasi');
            $table->date('tanggal');
            $table->enum('status',['menikah','belum menikah']);
            $table->string('ktp');
            $table->string('kk');
            $table->string('npwp');
            $table->date('tgl_diterima')->nullable();
            $table->unsignedInteger('pegawai')->nullable();
            $table->foreign('pegawai')->references('nip')->on('pegawais');
            $table->unsignedInteger('customer');
            $table->foreign('customer')->references('idcustomers')->on('customers');
            $table->timestamps();
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verifikasis');
        //
    }
}
