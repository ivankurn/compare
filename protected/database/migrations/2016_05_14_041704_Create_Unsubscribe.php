<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnsubscribe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('Unsubscribe', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->Increments('id_unsubscribe');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('Users');
            $table->text('alasan');
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
        Schema::drop('Unsubscribe');
    }
}
