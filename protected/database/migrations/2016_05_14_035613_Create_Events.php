<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Events', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id_event');
            
            $table->integer('id_store')->unsigned();
            $table->foreign('id_store')->references('id_store')->on('Store');
            $table->string('nama_event');
            $table->dateTime('waktu_start');
            $table->dateTime('waktu_end');
            $table->text('deskripsi');
            $table->string('gambar', 100)->nullable();
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
        Schema::drop('Events');
    }
}
