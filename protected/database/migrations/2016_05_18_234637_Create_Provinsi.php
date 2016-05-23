<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvinsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Provinsi', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id_provinsi');
			$table->integer('id_pulau')->unsigned();
            $table->foreign('id_pulau')->references('id_pulau')->on('Pulau');
            $table->string('nama_provinsi', 30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Provinsi');
    }
}
