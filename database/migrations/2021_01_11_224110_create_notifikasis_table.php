<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('pesan');
            $table->enum('dibaca', ['sudah', 'belum']);
            $table->unsignedInteger('pegawai')->nullable();
            $table->foreign('pegawai')->references('nip')->on('pegawais');
            $table->unsignedInteger('customer')->nullable();
            $table->foreign('customer')->references('idcustomers')->on('customers');
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
        Schema::dropIfExists('notifikasis');
    }
}
