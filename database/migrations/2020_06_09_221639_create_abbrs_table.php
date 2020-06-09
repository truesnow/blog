<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAbbrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = 'abbrs';
        Schema::create($table, function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id')->comment('主键ID');
            $table->string('abbr', 255)->comment('缩写')->default('');
            $table->string('full_name', 255)->comment('全拼')->default('');
            $table->string('cn_name', 255)->comment('中文名')->default('');
            $table->string('desc', 1024)->comment('说明')->default('');
            $table->timestamp('created_at')->useCurrent()->comment('创建时间');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('创建时间');

            $table->index('abbr', 'idx_abbr');
        });

        DB::statement("ALTER TABLE `$table` COMMENT '计算机专业名词缩写表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('abbrs', function (Blueprint $table) {
            Schema::drop('abbrs');
        });
    }
}
