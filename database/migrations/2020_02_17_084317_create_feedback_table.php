<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id_feedback');
            $table->string('isi');
            $table->date('tanggal_feedback');
            $table->date('reply');
            $table->unsignedInteger('pegawai');
            $table->foreign('pegawai')->references('nip')->on('pegawais');
            $table->unsignedInteger('customer');
            $table->foreign('customer')->references('idcustomers')->on('customers');
            $table->unsignedInteger('lokasi');
            $table->foreign('lokasi')->references('idlokasi')->on('lokasis');
            $table->enum('sentimen', ['positif','negatif'])->nullable();
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
        Schema::dropIfExists('feedback');
    }
}
