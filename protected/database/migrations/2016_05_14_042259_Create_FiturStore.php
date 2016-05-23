<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiturStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FiturStore', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->integer('id_store')->unsigned();
            $table->foreign('id_store')->references('id_store')->on('Store');


            $table->integer('id_fitur')->unsigned();
            $table->foreign('id_fitur')->references('id_fitur')->on('Fitur');
            $table->unique(['id_store', 'id_fitur'], 'composite_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('FiturStore');
    }
}
