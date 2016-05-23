<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cards', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id_card');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('Users');
            $table->char('card_number', 16);
            $table->char('distribution_id', 32);
            $table->char('card_pin', 6);
            $table->enum('status', array('Activated', 'Not Activated'));
            $table->integer('point');
            $table->integer('balance');
			$table->string('customer');
            $table->datetime('issued_date');
            $table->datetime('activated_date');
            $table->datetime('confirmed_date');
            $table->datetime('expired_date');

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
        Schema::drop('Cards');
    }
}
