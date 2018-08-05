<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('log_id');
            $table->integer('user_id')->nullable();
            $table->string('user_model')->nullable();
            $table->integer('subject_id')->nullable();
            $table->string('subject_model')->nullable();
            $table->integer('ip')->unsigned();
            $table->string('user_agent');
            $table->string('method');
            $table->string('url');
            $table->string('query_string')->nullable();
            $table->string('form_data')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('visit_logs');
    }
}
