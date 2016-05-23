<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Store', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id_store');
            $table->char('slug_store', 12);
            $table->string('nama_store');
            $table->string('alamat_store');
            $table->string('kota_store', 100);
			$table->string('provinsi_store', 100);
			$table->string('pulau', 100);
			$table->string('kodepos_store', 100);
            $table->string('latitude', 30);
            $table->string('longitude', 30);
            $table->time('jam_buka');
            $table->time('jam_tutup');
            $table->string('phone_store', 25);
           
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
        Schema::drop('Store');
    }
}
