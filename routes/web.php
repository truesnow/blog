<?php

Route::get('/', 'PagesController@index')->name('home');// Default home: diana
Route::get('/index/default', 'PagesController@home')->name('home.default');
Route::get('signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');