<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceLineTable extends Migration
{

    public function up()
    {
        Schema::create('service_line', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no');
            $table->string('service_item_line_resource_no');
            $table->string('type');
            $table->string('no');
            $table->string('description');
            $table->string('unit');
            $table->double('quantity');
            $table->double('unit_price');
            $table->double('amount');
            $table->integer('line_no');
            $table->string('customer_no');
            $table->string('location_code');
            $table->unique(array('order_no', 'service_item_line_resource_no'));
            $table->foreign('order_no')->references('order_no')->on('service_item_header');
        });
    }

    public function down()
    {
        Schema::table('service_line', function (Blueprint $table) {
            Schema::drop('service_line');
        });
    }
}
