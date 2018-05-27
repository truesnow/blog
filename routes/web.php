<?php

Route::get('/', 'PagesController@index')->name('home');

Route::get('signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');
Route::get('users/{user}/avatar/edit', 'UsersController@editAvatar')->name('users.avatar.edit');
Route::post('users/{user}/avatar', 'UsersController@updateAvatar')->name('users.avatar.update');
Route::get('users/{user}/password/edit', 'UsersController@editPassword')->name('users.password.edit');
Route::patch('users/{user}/password', 'UsersController@updatePassword')->name('users.password.update');

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
