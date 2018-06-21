<?php

namespace App\Models\Traits;

trait TopOptionsHelper
{
    public static function getTopOptions($placeholder = [])
    {
        $list = static::where('parent_id', 0)->get();
        $map = $placeholder;
        foreach ($list as $k => $v) {
            $map[$v['id']] = $v['name'];
        }

        return $map;
    }
}