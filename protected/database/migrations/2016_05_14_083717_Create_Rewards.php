<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('Rewards', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id_reward');

            $table->string('nama_reward');
            $table->text('deskripsi');
            $table->string('reward');
            $table->string('gambar');
            
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
        Schema::drop('Reward');
    }
}
