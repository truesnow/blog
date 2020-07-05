<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateMilestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milestones', function (Blueprint $table) {
            $table->increments('id')->comment('主键ID');
            $table->string('version', 64)->nullable(false)->comment('发布版本');
            $table->string('content', 1024)->nullable(false)->comment('发布内容');
            $table->string('detail', 2048)->nullable(false)->default('')->comment('发布详情');
            $table->tinyInteger('type')->default(0)->comment('类型(1:前端功能;2:管理后台;3:接口;4:脚本服务)');
            $table->timestamp('created_at')->useCurrent()->comment('创建时间');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新时间');
        });

        DB::statement("ALTER TABLE `milestones` COMMENT '里程碑表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('milestones');
    }
}
