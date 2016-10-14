<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceItemHeaderTable extends Migration
{

    public function up()
    {
        Schema::create('service_item_header', function (Blueprint $table) {
            $table->string('order_no')->primary();
            $table->string('description');
            $table->string('customer_no');
            $table->string('customer_name');
            $table->string('customer_information');
            $table->string('contact_no');
            $table->string('contact_name');
            $table->string('address');
            $table->string('city');
            $table->string('post_code');
            $table->string('phone_no');
            $table->string('mobile_no');
            $table->string('email');
            $table->string('status');
            $table->string('fax_no');
            $table->string('order_type');
            $table->date('order_date');
            $table->string('state');
            $table->string('general_comment');
            $table->string('service_comment');
            $table->timestamps(); //dateSync
        });
    }

    public function down()
    {
        Schema::table('service_item_header', function (Blueprint $table) {
            Schema::drop('service_item_header');
        });
    }
}
