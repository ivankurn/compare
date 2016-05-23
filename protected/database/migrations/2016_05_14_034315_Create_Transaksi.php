<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Transaksi', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id_transaksi');
            $table->char('receipt_number', 12);
            
            $table->integer('id_store')->unsigned();
            $table->foreign('id_store')->references('id_store')->on('Store');

            $table->integer('id_card')->unsigned();
            $table->foreign('id_card')->references('id_card')->on('Cards');

            $table->enum('tipe', array('Redemption', 'Topup', 'Void', 'PointRedemption'));
            
            $table->integer('amount');
            
            $table->enum('status', array('Accepted', 'Decline', 'Void By'));

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
        Schema::drop('Transaksi');
    }
}
