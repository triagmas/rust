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

Route::get('register', 'HomeController@getRegister');
Route::get('login', array('as' => 'login', 'uses' => 'HomeController@getLogin'));

Route::post('register', 'HomeController@postRegister');
Route::post('login', 'HomeController@postLogin');

Route::group(array('before' => 'auth'), function() 
{
	Route::get('admin', 'AdminController@index');
	Route::get('logout', 'HomeController@getLogout');
});
