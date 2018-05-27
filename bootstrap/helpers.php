<?php

/**
 * 将当前页面路由名称中的 `.` 替换为 `-`，作为当前视图页面 class
 * @return string 路由视图 class 名称
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}
