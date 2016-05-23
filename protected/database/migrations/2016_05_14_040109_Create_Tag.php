<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('Tag', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->integer('id_menu')->unsigned();
            $table->foreign('id_menu')->references('id_menu')->on('Menu');
            $table->string('tag', 50);
            $table->unique(['id_menu', 'tag'], 'composite_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Tag');
    }
}
