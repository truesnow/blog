<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {

    }

    // 实现主题功能，检测主题下是否存在指定页面，没有则使用默认主题页面
    public function view($view = null, $data = [], $mergeData = [])
    {
        // 获取 theme 顺序：get 参数 > session > 默认配置
        $theme = request()->input('theme', session('theme', config('app.theme', '')));
        session(['theme' => $theme]);
        $theme_view = 'themes.' . $theme . '.' . $view;
        if (View::exists($theme_view)) {
            return view($theme_view, $data, $mergeData);
        } else {
            return view($view, $data, $mergeData);
        }
    }
}
