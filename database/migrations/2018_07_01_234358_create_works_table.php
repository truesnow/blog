<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration 
{
	public function up()
	{
		Schema::create('works', function(Blueprint $table) {
            $table->increments('id');
            $table->string('category')->index();
            $table->string('name')->index();
            $table->string('url');
            $table->string('description')->nullable()->default('');
            $table->string('image')->nullable()->default('');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('works');
	}
}
