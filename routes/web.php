<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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
Route::get('faq','FaqpageController@show')->name('faq');
Route::post('faq', 'FaqpageController@create')->name('createFaq');
Route::get('about','AboutpageController@show')->name('about');
Route::get('contact','ContactpageController@show')->name('contact');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('forgot-password','ForgotPasswordController@show')->middleware('guest')->name('password.request');
Route::post('forgot-password', 'ForgotPasswordController@request')->middleware('guest')->name('password.email');
Route::get('reset-password', 'ForgotPasswordController@showRecover')->middleware('guest')->name('password.reset');
Route::post('reset-password', 'ForgotPasswordController@recover')->middleware('guest')->name('password.update');

//Profile
Route::get('profile','ProfileController@show')->name('profile');
Route::post('profile','ProfileController@update');
Route::post('profile/avatar','ProfileController@updateAvatar')->name('profile.avatar');  
Route::get('profile/{username}','ProfileController@showUser');//mostrar pagina de outro utilizador
Route::post('profile/delete','ProfileController@delete')->name('profile.delete');

//Project
Route::get('project/create','ProjectController@showCreate')->name('project/create');
Route::post('project/create','ProjectController@create');
Route::get('project/{project_id}','ProjectController@show')->where(['project_id'=>'[0-9]+'])->name('project');
Route::get('project/{project_id}/members','ProjectController@showMembers')->name('project.members');
Route::get('project/{project_id}/edit','ProjectController@showUpdate')->name('project.editShow');
Route::post('project/{project_id}/edit','ProjectController@update')->name('project.edit');

Route::post('project/{project_id}/leave','ProjectController@leave')->name('project.leave');
Route::post('project/{project_id}/archive','ProjectController@archive')->name('project.archive');
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
Route::get('api/project/{project_id}/task/{task_id}','TaskController@showTask');
Route::post('api/project/{project_id}/task/{task_id}/addComment','TaskController@addComment');
Route::post('task/edit','TaskController@update')->name('task/edit');
Route::get('task/delete','TaskController@delete')->name('task/delete');
//Search
Route::post('/api/search', 'SearchController@search');


//admin
Route::get('admin/dashboard','AdminController@show')->name('admin/dashboard'); // dashboard admin