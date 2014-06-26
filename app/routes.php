<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('base');
});

Route::get('register', array('as' => 'register', 'uses' => 'AuthController@getRegister'));
Route::get('login', array('as' => 'login', 'uses' => 'AuthController@getLogin'));

Route::post('register', 'AuthController@postRegister');
Route::post('login', 'AuthController@postLogin');

Route::group(array('before' => 'auth'), function() 
{
	Route::get('admin', array('as' => 'admin', 'uses' => 'AdminController@index'));
	Route::get('logout', 'AuthController@getLogout');
});

App::missing(function($exception)
{
    return Response::view('common.errors', array(), 404);
});

//Раздел администрирования
Route::group(array('prefix' => 'admin'), function()
	{
		//Администрирование пользователей
		Route::group(array('prefix' => 'users'), function()
			{
				Route::get('/', array('as' => 'users', 'uses' => 'App\Controllers\Admin\UsersController@getIndex'));
				Route::get('create', array('as' => 'create/user', 'uses' => 'App\Controllers\Admin\UsersController@getCreate'));
				Route::post('create', 'App\Controllers\Admin\UsersController@postCreate');
				Route::get('{userId}/edit', array('as' => 'update/user', 'uses' => 'App\Controllers\Admin\UsersController@getEdit'));
				Route::post('{userId}/edit', 'App\Controllers\Admin\UsersController@postEdit');
				Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'App\Controllers\Admin\UsersController@getDelete'));
				//Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'App\Controllers\Admin\UsersController@getRestore'));
			});
	});