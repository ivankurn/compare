<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Kota', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id_kota');
            $table->integer('id_provinsi')->unsigned();
			$table->foreign('id_provinsi')->references('id_provinsi')->on('Provinsi');
            $table->string('nama_kota', 30);
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
