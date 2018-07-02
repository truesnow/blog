<?php

namespace App\Models;

class Work extends Model
{
    use Traits\DataHelper;

    protected $fillable = ['category', 'name', 'url', 'description', 'image'];

    const CATEGORY_TRANSLATION = 'translation';
    const CATEGORY_PROJECT = 'project';
    const CATEGORY_REFERENCE = 'reference';

    public static $category_map = [
        self::CATEGORY_TRANSLATION => '翻译',
        self::CATEGORY_PROJECT => '项目',
        self::CATEGORY_REFERENCE => '参考',
    ];
}
