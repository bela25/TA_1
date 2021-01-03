<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembatalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembatalans', function (Blueprint $table) {
            $table->increments('id_pembatalan');
            $table->date('tanggal_batal');
            $table->longtext('alasan');
            $table->unsignedInteger('admin');
            $table->foreign('admin')->references('nip')->on('pegawais');
            $table->unsignedInteger('transaksi');
            $table->foreign('transaksi')->references('id_transaksi')->on('transaksis');
            $table->string('gambar_bukti');
            $table->date('tgl_pengembalian');
            $table->enum('status', ['aktif','tidak aktif']);
            $table->text('alasan_pegawai')->nullable();
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
        Schema::dropIfExists('pembatalans');
    }
}
