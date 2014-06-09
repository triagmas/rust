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
	Route::get('admin', 'AdminController@index');
	Route::get('logout', 'AuthController@getLogout');
});
