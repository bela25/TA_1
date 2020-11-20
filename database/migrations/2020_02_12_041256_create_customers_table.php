<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('idcustomers');
            $table->string('nama');
            $table->date('tgl_lahir');
            $table->string('no_ktp');
            $table->enum('gender',['perempuan','laki-laki']);
            $table->string('no_telp');
            $table->string('alamat');
            $table->string('email');
            $table->string('username');
            $table->string('password');
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
        Schema::dropIfExists('customers');
    }
}
