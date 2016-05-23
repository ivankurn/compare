<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Users', function(Blueprint $table){
        	$table->engine = 'InnoDB';
            $table->increments('id_user');
            $table->string('nama_user');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('alamat_user');
            $table->string('kota_user');
            $table->char('country_code_user', 4);
            $table->char('mobile_phone_user', 12);
            $table->date('tanggal_lahir');
            $table->string('occupation');
            $table->enum('gender', array('Male', 'Female'));
            $table->string('foto');
            $table->integer('saldo')->default('0');
            $table->char('verifikasi_email', 5);
            $table->boolean('is_admin')->default('0');
            $table->rememberToken();
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
        Schema::drop('Users');
    }
}
