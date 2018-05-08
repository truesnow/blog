<?php

// Route::get('/', 'PagesController@index')->name('home');
Route::get('/', 'PagesController@home')->name('home');
Route::get('signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');