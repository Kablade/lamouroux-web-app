<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantityItemPerLocation extends Migration
{

    public function up()
    {
        Schema::create('quantity_item_per_location', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location_code');
            $table->string('item_id');
            $table->string('quantity');

            $table->unique(array('location_code', 'item_id'));
        });
    }

    public function down()
    {
        Schema::table('user_data', function (Blueprint $table) {
            Schema::drop('user_data');
        });
    }
}
