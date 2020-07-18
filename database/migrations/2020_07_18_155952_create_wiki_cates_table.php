<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateWikiCatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_cates', function (Blueprint $table) {
            $table->increments('id')->comment('主键ID');
            $table->string('name', 64)->nullable(false)->comment('分类名称');
            $table->string('desc', 1024)->nullable(false)->default('')->comment('分类描述');
            $table->tinyInteger('resource_type')->nullable(false)->default('0')->comment('资源类型(1:链接;2:图片;3:文本)');
            $table->integer('ordinal')->nullable(false)->default('100')->comment('排序值(越小越前)');
            $table->boolean('enable_status')->nullable(false)->default('1')->comment('启用状态(0:禁用;1:启用)');
            $table->timestamp('created_at')->useCurrent()->comment('创建时间');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新时间');

            $table->index('ordinal', 'idx_ordinal');
        });

        DB::statement("ALTER TABLE `wiki_cates` COMMENT 'wiki资源类型表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wiki_cates');
    }
}
