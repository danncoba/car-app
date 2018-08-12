<?php

Route::get('/', 'WelcomeController@index')->name('root');

Route::get('/search/{category}', 'WelcomeController@search')->name('search_cars');

// Authentication Routes...
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::post('/dashboard/categories', 'CategoriesController@create')->name('create_category');
Route::post('/dashboard/categories/{category}/update', 'CategoriesController@update')->name('update_category');
Route::post('/dashboard/categories/{category}/delete', 'CategoriesController@delete')->name('delete_category');

Route::get('/dashboard/categories', 'CategoriesController@index')->name('categories');
Route::get('/dashboard/categories/new', 'CategoriesController@newAction')->name('new_category');
Route::get('/dashboard/categories/{category}', 'CategoriesController@edit')->name('edit_category');

Route::get('/member/dashboard', 'CarsController@index')->name('member_cars');
Route::get('/member/cars/new', 'CarsController@newAction')->name('member_new_car');
Route::get('/member/cars/{c}', 'CarsController@edit')->name('member_edit_car');
Route::post('/member/cars/{c}', 'CarsController@update')->name('member_update_car');
Route::post('/member/cars', 'CarsController@create')->name('member_create_car');
Route::post('/member/cars/{car}/delete', 'CarsController@delete')->name('member_delete_car');

Route::post('/dashboard/cars/approve/{car}', 'AdminCarsController@approve')->name('approve_car');
