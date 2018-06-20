<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookmarkCategoriesTable extends Migration 
{
	public function up()
	{
		Schema::create('bookmark_categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->integer('parent_id')->unsigned()->default('0');
            $table->string('description')->default('');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('bookmark_categories');
	}
}
