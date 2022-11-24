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
    return redirect('home');
})->name('/');

Route::get('home','HomepageController@show')->name('home');
Route::get('faq','HomepageController@show')->name('faq');
Route::get('about','HomepageController@show')->name('about');
Route::get('contacts','HomepageController@show')->name('contacts');

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
Route::get('project/edit','ProjectController@showUpdate')->name('project/editShow');
Route::post('project/edit','ProjectController@update')->name('project/edit');
Route::post('project/leave','ProjectController@leave')->name('project/leave');
Route::post('project/inviteMember', 'InviteController@create')->name('project/inviteMember');
Route::post('project/acceptInvite}', 'InviteController@accept')->name('project/acceptInvite');
Route::post('project/rejectInvite}', 'InviteController@reject')->name('project/rejectInvite');

Route::post('api/project/favorite/create', 'FavoriteController@create');
Route::post('api/project/favorite/delete', 'FavoriteController@delete');
Route::post('api/project/removeMember','ProjectController@removeMember');
Route::post('api/notification/delete', 'NotificationController@delete');
Route::post('api/project/upgradeMember','ProjectController@upgradeMember');


//Task
Route::get('task','TaskController@show')->name('task');
Route::post('task/create','TaskController@create')->name('task/create');
Route::get('task/edit','TaskController@showUpdate')->name('task/edit');
Route::post('task/edit','TaskController@update')->name('task/edit');
Route::get('task/delete','TaskController@delete')->name('task/delete');

//Search
Route::post('api/search', 'SearchController@search');


