<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id_unit');
            $table->string('no_unit');
            $table->integer('lantai');
            $table->enum('status',['terjual','booking','tersedia']);
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
        Schema::dropIfExists('units');
    }
}
