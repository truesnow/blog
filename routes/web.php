<?php

// 首页
Route::get('/', 'PagesController@index')->name('home');

// 用户个人中心
Route::resource('users', 'UsersController');
Route::get('users/{user}/avatar/edit', 'UsersController@editAvatar')->name('users.avatar.edit');
Route::post('users/{user}/avatar', 'UsersController@updateAvatar')->name('users.avatar.update');
Route::get('users/{user}/password/edit', 'UsersController@editPassword')->name('users.password.edit');
Route::patch('users/{user}/password', 'UsersController@updatePassword')->name('users.password.update');
Route::get('users/{user}/messages', 'UsersController@messages')->name('users.messages');
Route::get('users/{user}/articles', 'UsersController@articles')->name('users.articles');
Route::get('users/{user}/replies', 'UsersController@replies')->name('users.replies');

// 账号管理
Route::get('signup', 'UsersController@create')->name('signup');
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// 留言
Route::resource('messages', 'MessagesController', ['only' => ['index', 'store', 'show', 'destroy']]);

// 文章
Route::resource('articles', 'ArticlesController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('articles/{article}/{slug?}', 'ArticlesController@show')->name('articles.show');
Route::post('articles/upload_image', 'ArticlesController@uploadImage')->name('articles.upload_image');
Route::post('articles/editormd_upload_image', 'ArticlesController@editormdUploadImage')->name('articles.editormd_upload_image');
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

// 专题
Route::resource('subjects', 'SubjectsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

// 资源
Route::post('resources/editormd_paste_upload_image', 'ResourcesController@editormdPasteUploadImage')->name('resources.editormd_paste_upload_image');
Route::get('resources/create', 'ResourcesController@create')->name('resources.create');
Route::post('resources/store', 'ResourcesController@store')->name('resources.store');
Route::get('resources/show', 'ResourcesController@store')->name('resources.show');


// 通知
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

// 书签
Route::get('bookmarks', 'BookmarksController@index')->name('bookmarks.index');

// 作品
Route::resource('works', 'WorksController', ['only' => ['index']]);

// 缩略词
Route::resource('abbrs', 'AbbrsController', ['only' => ['index']]);

/**
 * pages
 */
// 有趣的前端
Route::get('funjs/random-circles', 'PagesController@randomCircles')->name('funjs.random-circles');
Route::get('funjs/bouncing-balls', 'PagesController@bouncingBalls')->name('funjs.bouncing-balls');

// ghtoc
Route::get('ghtoc', 'PagesController@ghtoc')->name('ghtoc');
Route::post('ghtoc/run', 'PagesController@ghtocRun')->name('ghtoc.run');

// 外部 URL 访问记录
Route::post('redirect', 'PagesController@redirectTo')->name('redirect');

// 静态页面
Route::get('{name}', 'PagesController@show')->name('pages.show');
