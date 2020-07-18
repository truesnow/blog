<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WikiCate extends Model
{
    use Traits\FieldMapHelper;

    protected $fillable = ['name', 'desc', 'resource_type', 'ordinal', 'enable_status'];

    /**
     * 资源类型
     */
    const RESOURCE_TYPE_LINK = 1;
    const RESOURCE_TYPE_IMAGE = 2;
    const RESOURCE_TYPE_TEXT = 3;

    const RESOURCE_TYPE_MAP = [
        self::RESOURCE_TYPE_LINK => '链接',
        self::RESOURCE_TYPE_IMAGE => '图片',
        self::RESOURCE_TYPE_TEXT => '文本',
    ];

    public static function allEnabledCates() {
        return WikiCate::where(['enable_status' => ENABLED])->orderBy('ordinal', 'asc')->get();
    }
}
