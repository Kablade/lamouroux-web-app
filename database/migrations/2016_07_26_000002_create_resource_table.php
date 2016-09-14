<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceTable extends Migration
{
    public function up()
    {
        Schema::create('resource', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('description');
            $table->string('location_code');
        });
    }

    public function down()
    {
        Schema::table('resource', function (Blueprint $table) {
            Schema::drop('resource');
        });
    }
}
