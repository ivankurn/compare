<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Menu', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id_menu');
            $table->string('nama_menu', 100);
            $table->string('available_size', 30)->nullable();
            $table->string('available_type', 30)->nullable();
            $table->string('nama_menu', 100);
            $table->text('deskripsi');
            $table->string('gambar', 100);
            $table->integer('redeem_point')->nullable();
            $table->integer('id_kategori')->unsigned();
            $table->foreign('id_kategori')->references('id_kategori')->on('Kategori');
            $table->enum('status', array('Aktif', 'Tidak Aktif'));


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
        Schema::drop('Menu');
    }
}
