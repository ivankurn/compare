<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactUs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ContactUs', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->Increments('id_contactus');
            $table->string('nama', 100);
            $table->string('email', 150)->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->string('alamat');
            $table->enum('perihal', array('Carrer Opportunity', 'General Enquiry', 'Sales Enquiry'));
            $table->integer('id_job')->nullable();
			table->string('cv', 100)->nullable();
            $table->text('pesan');
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
        Schema::drop('ContactUs');
    }
}
