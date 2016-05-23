<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogSms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LogSms', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id_log_sms');
            
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('Users');
            $table->string('kepada');
            
            $table->text('isi_sms');
            
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
        Schema::drop('LogSms');
    }
}
