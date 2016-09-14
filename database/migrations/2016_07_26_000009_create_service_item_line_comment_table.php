<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceItemLineCommentTable extends Migration
{

    public function up()
    {
        Schema::create('service_item_line_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_item_line_no');
            $table->string('type');
            $table->string('comment');
            $table->integer('line_no');
            $table->unique(array('service_item_line_no', 'line_no'));
        });
    }

    public function down()
    {
        Schema::table('comment', function (Blueprint $table) {
            Schema::drop('service_item_line_comment');
        });
    }
}
