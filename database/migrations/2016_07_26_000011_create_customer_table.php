<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->string('id')->primary();
        });
    }

    public function down()
    {
        Schema::table('customer', function (Blueprint $table) {
            Schema::drop('customer');
        });
    }
}
