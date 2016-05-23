<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiReward extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('TransaksiReward', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id_transaksi_reward');
            $table->integer('id_transaksi')->unsigned();
            $table->foreign('id_transaksi')->references('id_transaksi')->on('Transaksi');
            $table->integer('id_reward')->unsigned();
            $table->foreign('id_reward')->references('id_reward')->on('Rewards');
           
            
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
