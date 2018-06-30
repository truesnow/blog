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

    public $theme;

    public function __construct()
    {
        $this->theme = (new Request())->input('theme', config('app.theme'));
    }

    // 实现主题功能，检测主题下是否存在指定页面，没有则使用默认主题页面
    public function view($view = null, $data = [], $mergeData = [])
    {
        $theme_view = 'themes.' . $this->theme . '.' . $view;
        if (View::exists($theme_view)) {
            return view($theme_view, $data, $mergeData);
        } else {
            return view($view, $data, $mergeData);
        }
    }
}
