<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ReportMember', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id_report');
            $table->integer('total_transaction');
            $table->integer('total_member');
            $table->integer('total_male');
            $table->integer('total_female');
            $table->integer('avg_age');
            $table->integer('avg_spending');
            $table->integer('avg_spending_a');
            $table->integer('avg_spending_b');
            $table->integer('avg_spending_c');
            $table->integer('avg_spending_d');
            $table->integer('avg_spending_e');
            
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
         Schema::drop('ReportMember');
    }
}
