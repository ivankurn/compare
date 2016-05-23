<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('Job', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->Increments('id_job');
            $table->string('nama_job', 100);
            $table->text('requirement', 150);
            $table->string('gambar', 60);
            $table->date('date_start');
            $table->date('date_end');
            $table->boolean('status')->default('1');
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
        Schema::drop('Job');
    }
}
