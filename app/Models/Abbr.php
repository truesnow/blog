<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Abbr extends Model
{

    protected $fillable = ['abbr', 'full_name', 'cn_name', 'desc'];

    /**
     * 按字母统计缩略词数量
     */
    public static function getCountMapByFirstLetterGroup() {
        return [
            'total' => self::count(),
            'ag' => self::getCountByAbbrRegex('^[a-g]'),
            'hn' => self::getCountByAbbrRegex('^[h-n]'),
            'opq' => self::getCountByAbbrRegex('^[opq]'),
            'rst' => self::getCountByAbbrRegex('^[rst]'),
            'uvw' => self::getCountByAbbrRegex('^[uvw]'),
            'xyz' => self::getCountByAbbrRegex('^[xyz]'),
        ];
    }

    /**
     * 根据正则表达式查询 abbr 统计数量
     */
    private static function getCountByAbbrRegex($regex) {
        return self::whereRaw("abbr REGEXP '$regex'")->count();
    }

}
