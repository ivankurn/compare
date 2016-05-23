<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LogEmail', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id_log_email');
            
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('Users');
            $table->string('kepada');
            $table->string('subject');
            $table->text('isi_email');
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
        Schema::drop('LogEmail');
    }
}
