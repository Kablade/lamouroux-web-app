<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{

    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email');
            $table->string('password');
            $table->string('last_login');
            $table->rememberToken();
        });
    }

    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            Schema::drop('user');
        });
    }
}
