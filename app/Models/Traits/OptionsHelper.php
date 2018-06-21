<?php

namespace App\Models\Traits;

trait OptionsHelper
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

    public static function getSubOptions($placeholder = [])
    {
        $list = static::where('parent_id', '!=', 0)->with('parent')->get()->toArray();
        // dd($list);exit;
        $map = $placeholder;
        foreach ($list as $k => $v) {
            $map[$v['id']] = $v['parent']['name'] . '-' . $v['name'];
        }

        return $map;
    }
}
