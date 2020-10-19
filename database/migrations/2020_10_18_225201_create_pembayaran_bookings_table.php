<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_bookings', function (Blueprint $table) {
            $table->increments('id_pembayaranbooking');
            $table->date('tanggal_bayar');
            $table->double('nominal',10,2);
            $table->string('gambar_bukti');
            $table->unsignedInteger('transaksi');
            $table->foreign('transaksi')->references('id_transaksi')->on('transaksis');
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
        Schema::dropIfExists('pembayaran_bookings');
    }
}
