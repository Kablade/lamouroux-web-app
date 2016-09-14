<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTable extends Migration
{
    public function up()
    {
        Schema::create('item', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('description');
            $table->string('unit');
            $table->string('location_code');
            $table->float('quantity');
        });
    }

    public function down()
    {
        Schema::table('item', function (Blueprint $table) {
            Schema::drop('item');
        });
    }
}
