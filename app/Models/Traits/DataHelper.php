<?php

namespace App\Models\Traits;

trait DataHelper
{
    public static function groupAll($group_key)
    {
        $all = static::all();

        return array_group($all, $group_key);
    }
}
