<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceItemLineTable extends Migration
{

    public function up()
    {
        Schema::create('service_item_line', function (Blueprint $table) {
            $table->integer('id');
            $table->string('order_no');
            $table->string('resource_no');
            $table->string('description');
            $table->string('bottle_no');
            $table->string('shift_bottle_no');
            $table->string('line_no');
            $table->string('fluid');
            $table->integer('fluid_new');
            $table->integer('fluid_recovered');
            $table->integer('fluid_reintroduced');
            $table->integer('fluid_retired');
            $table->double('fluid_quantity');
            $table->integer('fluid_nature');
            $table->integer('fluid_action');
            $table->integer('fluid_added_quantity');
            $table->date('real_start_date');
            $table->date('real_end_date');
            $table->string('truck_brand');
            $table->string('truck_model');
            $table->string('truck_serial_no');
            $table->boolean('certification');
            $table->boolean('work_order_sheet');
            $table->string('location');
            $table->string('intervention_address');
            $table->integer('intervention_reason');
            $table->integer('inspection_period');
            $table->date('control_date');
            $table->date('last_control_date');
            $table->string('leak_result');
            $table->integer('leak_count');
            $table->string('comment');
            $table->double('load_amount');
            $table->integer('leak_location');
            $table->timestamps();
            $table->foreign('order_no')->references('order_no')->on('service_item_header');
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
