<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
	public function up()
	{
		Schema::create('replies', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned()->default(0)->index();
            $table->integer('user_id')->unsigned()->default(0);
            $table->text('content');
            $table->integer('like')->unsigned()->default(0);
            $table->integer('parent_id')->unsigned()->default(0)->nullable();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('replies');
	}
}
