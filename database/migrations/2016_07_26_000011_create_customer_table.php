<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('address');
            $table->string('address2');
            $table->string('city');
            $table->string('post_code');
            $table->string('phone');
            $table->string('mobile');
            $table->string('email');
            $table->string('company_no');
            $table->integer('type');
        });
    }

    public function down()
    {
        Schema::table('customer', function (Blueprint $table) {
            Schema::drop('customer');
        });
    }
}
