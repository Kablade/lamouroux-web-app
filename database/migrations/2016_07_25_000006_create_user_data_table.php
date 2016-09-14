<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDataTable extends Migration
{

    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->primary();
            $table->string('location_code');
            $table->string('truck_brand');
            $table->string('truck_model');
            $table->string('truck_serial_no');
            $table->dateTime('checked_at');
            $table->string('name');
            $table->string('first_name');

            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    public function down()
    {
        Schema::table('user_data', function (Blueprint $table) {
            Schema::drop('user_data');
        });
    }
}
