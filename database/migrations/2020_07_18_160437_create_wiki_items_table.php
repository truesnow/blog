<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateWikiItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_items', function (Blueprint $table) {
            $table->increments('id')->comment('主键ID');
            $table->integer('subject_id')->nullable(false)->comment('wiki主题ID');
            $table->integer('cate_id')->nullable(false)->comment('wiki类别ID');
            $table->string('name', 64)->nullable(false)->comment('项目名称');
            $table->string('desc', 1024)->nullable(false)->default('')->comment('项目描述');
            $table->string('url', 512)->nullable(false)->default('')->comment('项目链接');
            $table->integer('content_id')->nullable(false)->default('0')->comment('文本内容ID');
            $table->integer('ordinal')->nullable(false)->default('100')->comment('排序值(越小越前)');
            $table->boolean('enable_status')->nullable(false)->default('1')->comment('启用状态(0:禁用;1:启用)');
            $table->timestamp('created_at')->useCurrent()->comment('创建时间');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新时间');

            $table->index('subject_id', 'idx_subject_id');
            $table->index('cate_id', 'idx_cate_id');
            $table->index('ordinal', 'idx_ordinal');
        });

        DB::statement("ALTER TABLE `wiki_items` COMMENT 'wiki项目表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wiki_items');
    }
}
