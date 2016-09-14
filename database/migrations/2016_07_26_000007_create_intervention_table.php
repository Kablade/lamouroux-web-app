<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterventionTable extends Migration
{

    public function up()
    {
        Schema::create('intervention', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no')->unique();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('description');

            $table->foreign('order_no')->references('order_no')->on('service_item_header');
        });
    }

    public function down()
    {
        Schema::table('intervention', function (Blueprint $table) {
            Schema::drop('intervention');
        });
    }
}
