<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceItemLineTable extends Migration
{

    public function up()
    {
        Schema::create('service_item_line', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no');
            $table->string('resource_no');
            $table->string('description');
            $table->string('bottle_no');
            $table->string('shift_bottle_no');
            $table->string('line_no');
            $table->double('fluid_new');
            $table->double('fluid_recovered');
            $table->double('fluid_reintroduced');
            $table->double('fluid_retired');
            $table->string('location');
            $table->timestamps();
            $table->unique(array('order_no', 'resource_no'));
        });
    }

    public function down()
    {
        Schema::table('service_item_line', function (Blueprint $table) {
            Schema::drop('service_item_line');
        });
    }
}
