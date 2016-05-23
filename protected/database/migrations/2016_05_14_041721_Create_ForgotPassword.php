<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForgotPassword extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ForgotPassword', function(Blueprint $table){
               $table->engine = 'InnoDB';
               $table->increments('id_forgot_password');
               $table->integer('id_user')->unsigned();
               $table->foreign('id_user')->references('id_user')->on('Users');
               $table->char('kode_forgot', 6);
               $table->date('valid_until');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ForgotPassword');
    }
}
