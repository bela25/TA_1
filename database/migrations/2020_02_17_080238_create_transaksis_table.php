<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->date('tanggal');
            $table->enum('jenis_bayar',['kpa','in house','lunas','kredit keras'])->nullable();
            $table->enum('status',['aktif','tidak aktif']);
            $table->enum('verifikasi',['diterima','belum diterima']);
            $table->date('tgl_pelunasan');
            $table->unsignedInteger('unit');
            $table->foreign('unit')->references('id_unit')->on('units');
            $table->unsignedInteger('pegawai');
            $table->foreign('pegawai')->references('nip')->on('pegawais');
            $table->unsignedInteger('customer');
            $table->foreign('customer')->references('idcustomers')->on('customers');
            $table->unsignedInteger('harga_jual');
            $table->foreign('harga_jual')->references('idhargajual')->on('harga_juals');
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
        Schema::dropIfExists('transaksis');
    }
}
