<?php

/**
 * 将当前页面路由名称中的 `.` 替换为 `-`，作为当前视图页面 class
 * @return string 路由视图 class 名称
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * 获取文章内容摘要：去除 HTML 标签和 PHP 标签，将换行替换为空格，截取指定长度
 * @param  [type]  $value  [description]
 * @param  integer $length [description]
 * @return [type]          [description]
 */
function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));

    return str_limit($excerpt, $length);
}