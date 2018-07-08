<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
	public function up()
	{
		Schema::create('pages', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('description')->default('')->nullable();
            $table->text('content');
            $table->integer('view_count')->unsigned()->default('0');
            $table->tinyInteger('is_show')->unsigned()->default('0');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('pages');
	}
}
