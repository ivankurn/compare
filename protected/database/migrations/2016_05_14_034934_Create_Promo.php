<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Promo', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id_promo');
            $table->string('id_store', 100)->nullable();
            $table->integer('id_pembuat')->unsigned();
            $table->foreign('id_pembuat')->references('id_user')->on('Users');
            $table->string('nama_promo');
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
        Schema::drop('Promo');
    }
}
