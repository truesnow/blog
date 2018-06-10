<?php

Route::get('/', 'PagesController@index')->name('home');

Route::get('signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');
Route::get('users/{user}/avatar/edit', 'UsersController@editAvatar')->name('users.avatar.edit');
Route::post('users/{user}/avatar', 'UsersController@updateAvatar')->name('users.avatar.update');
Route::get('users/{user}/password/edit', 'UsersController@editPassword')->name('users.password.edit');
Route::patch('users/{user}/password', 'UsersController@updatePassword')->name('users.password.update');
Route::get('users/{user}/messages', 'UsersController@messages')->name('users.messages');
Route::get('users/{user}/articles', 'UsersController@articles')->name('users.articles');
Route::get('users/{user}/replies', 'UsersController@replies')->name('users.replies');

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::resource('messages', 'MessagesController', ['only' => ['index', 'store', 'show', 'destroy']]);

Route::resource('articles', 'ArticlesController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('articles/{article}/{slug?}', 'ArticlesController@show')->name('articles.show');
Route::resource('subjects', 'SubjectsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

Route::post('upload_image', 'ArticlesController@uploadImage')->name('articles.upload_image');
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
