<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::get('home','HomepageController@show')->name('home');
Route::get('faq','HomepageController@show')->name('faq');
Route::get('about','HomepageController@show')->name('about');
Route::get('contacts','HomepageController@show')->name('contacts');


// API
/*Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');*/

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


//Profile
Route::get('profile','ProfileController@show')->name('profile');//mostrar pagina do utilizador logado
Route::post('profile','ProfileController@update');  
Route::get('profile/{username}','ProfileController@showUser');//mostrar pagina de outro utilizador

//Project
Route::get('project/{project_id}','ProjectController@show')->where(['project_id'=>'[0-9]+']);
Route::get('project/create','ProjectController@showCreate')->name('project/create');
Route::post('project/create','ProjectController@create');
Route::get('project/edit','ProjectController@showUpdate')->name('project/edit');
Route::post('project/edit','ProjectController@update')->name('project/edit');

//Task
Route::get('task','TaskController@show')->name('task');
Route::post('task/create','TaskController@create')->name('task/create');
Route::get('task/edit','TaskController@showUpdate')->name('task/edit');
Route::post('task/edit','TaskController@update')->name('task/edit');
