<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = ['version', 'content', 'type'];

    /**
     * type-类型(1:前端功能;2:管理后台;3:接口;4:脚本服务)
     */
    // 1:前端功能
    const TYPE_FRONTEND = 1;
    // 2:管理后台
    const TYPE_ADMIN_CONSOLE = 2;
    // 3:接口
    const TYPE_API = 3;
    // 4:脚本服务
    const TYPE_JOB = 4;

    const TYPE_MAP = [
        self::TYPE_FRONTEND => '新增前端功能',
        self::TYPE_ADMIN_CONSOLE => '新增管理后台功能',
        self::TYPE_API => '新增接口',
        self::TYPE_JOB => '新增脚本服务',
    ];
}
