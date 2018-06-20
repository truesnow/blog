<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookmarksTable extends Migration 
{
	public function up()
	{
		Schema::create('bookmarks', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('url');
            $table->integer('category_id')->unsigned()->default('0');
            $table->string('description')->default('');
            $table->string('icon')->default('');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('bookmarks');
	}
}
