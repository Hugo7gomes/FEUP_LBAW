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
Route::get('project/create','ProjectController@showCreate')->name('project/create');
Route::post('project/create','ProjectController@create');
Route::get('project/{project_id}','ProjectController@show')->where(['project_id'=>'[0-9]+'])->name('project');
Route::get('project/{project_id}/members','ProjectController@showMembers')->name('project.members');
Route::get('project/{project_id}/edit','ProjectController@showUpdate')->name('project.editShow');
Route::post('project/{project_id}/edit','ProjectController@update')->name('project.edit');

Route::post('project/{project_id}/leave','ProjectController@leave')->name('project.leave');
Route::post('api/project/{project_id}/inviteMember', 'InviteController@create');
Route::post('project/acceptInvite}', 'InviteController@accept')->name('project/acceptInvite');
Route::post('project/rejectInvite}', 'InviteController@reject')->name('project/rejectInvite');

Route::post('api/project/{project_id}/favorite/create', 'FavoriteController@create');
Route::post('api/project/{project_id}/favorite/delete', 'FavoriteController@delete');
Route::post('api/project/{project_id}/removeMember','ProjectController@removeMember');
Route::post('api/project/{project_id}/upgradeMember','ProjectController@upgradeMember');
Route::post('api/notification/delete', 'NotificationController@delete');



//Task
Route::post('task/create','TaskController@create')->name('task/create');
Route::get('api/project/{project_id}/task/{task_id}','TaskController@showUpdate');
Route::post('api/project/{project_id}/task/{task_id}/addComment','TaskController@addComment');
Route::post('task/edit','TaskController@update')->name('task/edit');
Route::get('task/delete','TaskController@delete')->name('task/delete');
//Search
Route::get('search','SearchController@Show')->name('search');
Route::get('api/search', 'SearchController@search');


