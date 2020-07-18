<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTextContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_contents', function (Blueprint $table) {
            $table->increments('id')->comment('主键ID');
            $table->string('table', 128)->nullable(false)->comment('关联表名');
            $table->integer('record_id')->nullable(false)->comment('记录ID');
            $table->mediumText('content')->comment('内容');
            $table->timestamp('created_at')->useCurrent()->comment('创建时间');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新时间');

            $table->unique(['table', 'record_id'], 'uniq_table_record_id');
        });

        DB::statement("ALTER TABLE `text_contents` COMMENT '文本内容表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('text_contents');
    }
}
