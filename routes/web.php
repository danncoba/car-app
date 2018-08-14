<?php

Route::get('/', 'WelcomeController@index')->name('root');

Route::get('/api/cars', 'WelcomeController@apiCars')->name('api_frontend_cars');
Route::get('/api/cars/search/{id}', 'WelcomeController@searchCars')->name('api_search_cars');

Route::get('/search/{category}', 'WelcomeController@search')->name('search_cars');

// Authentication Routes...
Route::get('/api/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/api/login', 'Auth\LoginController@login');
Route::get('/api/audi/fetch', 'WelcomeController@loadExternal')->name('fetch_audi_frontend');

Route::get('/api/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->post('register', 'Auth\RegisterController@register');

Route::get('/api/dashboard', 'HomeController@index')->name('home');
Route::get('/api/user', 'UserController@user')->name('user');

Route::post('/api/dashboard/categories', 'CategoriesController@create')->name('create_category');
Route::post('/api/dashboard/categories/{category}/update', 'CategoriesController@update')->name('update_category');
Route::post('/api/dashboard/categories/{category}/delete', 'CategoriesController@delete')->name('delete_category');

Route::get('/api/dashboard/categories', 'CategoriesController@index')->name('categories');
Route::get('/api/dashboard/categories/new', 'CategoriesController@newAction')->name('new_category');
Route::get('/api/dashboard/categories/{category}', 'CategoriesController@edit')->name('edit_category');
Route::get('/api/dashboard/categories/audi/fetch', 'CategoriesController@loadExternal')->name('load_audi_category');

Route::get('/member/dashboard', 'CarsController@index')->name('member_cars');
Route::get('/member/cars/new', 'CarsController@newAction')->name('member_new_car');
Route::get('/member/cars/{c}', 'CarsController@edit')->name('member_edit_car');
Route::post('/member/cars/{c}', 'CarsController@update')->name('member_update_car');
Route::post('/member/cars', 'CarsController@create')->name('member_create_car');
Route::post('/member/upload', 'CarsController@uploadPicture')->name('member_upload_picture');
Route::post('/member/cars/{car}/delete', 'CarsController@delete')->name('member_delete_car');

Route::post('/dashboard/cars/approve/{car}', 'AdminCarsController@approve')->name('approve_car');
Route::get('/{path}', 'WelcomeController@index')->where(['path' => '.*']);
