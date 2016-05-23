<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MenuPrice', function(Blueprint $table){
            $table->engine = 'InnoDB';
			$table->increments('price_id');
			$table->char('plu_id',8);
            $table->integer('id_menu')->unsigned();
			$table->foreign('id_menu')->references('id_menu')->on('Menu');
			$table->integer('id_store')->default(0);
            $table->enum('type', array('Hot', 'Iced', 'None'));
            $table->enum('size', array('S', 'M', 'R', 'MX', 'XX'));
            $table->integer('harga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('MenuPrice');
    }
}
