<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMottosTable extends Migration
{
	public function up()
	{
		Schema::create('mottos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('author')->nullable()->default('')->index();
            $table->string('source')->nullable()->default('');
            $table->string('portrait')->nullable()->default('');
            $table->text('content');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('mottos');
	}
}
