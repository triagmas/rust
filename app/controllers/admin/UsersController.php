<?php 
namespace App\Controllers\Admin;

use AdminController;
use Cartalyst\Sentry\Users\LoginRequiredException;
use Cartalyst\Sentry\Users\PasswordRequiredException;
use Cartalyst\Sentry\Users\UserExistsException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Config;
use Input;
use Lang;
use Redirect;
use Sentry;
use Validator;
use View;

class UsersController extends \AdminController {

	/**
	 * Display a listing of the resource.
	 * GET /user
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		// Выбор всех пользователей
		$users = Sentry::getUserProvider()->createModel();

		// Добавить удаленных?
		if (Input::get('withTrashed'))
		{
			$users = $users->withTrashed();
		}
		else if (Input::get('onlyTrashed'))
		{
			$users = $users->onlyTrashed();
		}

		// Постраничный вывод
		$users = $users->paginate()
			->appends(array(
				'withTrashed' => Input::get('withTrashed'),
				'onlyTrashed' => Input::get('onlyTrashed'),
			));

		// Вывод страницы
		return View::make('admin/users/index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /user/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		    return View::make('admin.users.add');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /user/create
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		try
		{

		$rules = array(
			'first_name'       => 'required|min:3',
			'last_name'        => 'required|min:3',
			'email'            => 'required|email|unique:users',
			'password'         => 'required|between:3,32',
			'password_confirm' => 'required|same:password',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::action('App\Controllers\Admin\UsersController@getCreate')->withInput()->withErrors($validator);
		}

			$user = Sentry::createUser(array(
				'first_name' => Input::get('first_name'),	
				'last_name' => Input::get('last_name'),
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'activated' => true,
				        'permissions' => array(
			            'user.create' => 1,
			            'user.delete' => 1,
			            'user.view'   => 1,
			            'user.update' => 1,
        	)));

        	if($user)
			{
				return Redirect::action('App\Controllers\Admin\UsersController@getIndex')->with(array('success' => 'Вы успшено зарегистрованые! Зайдите в систему!'));
			}
		}		

		//Сообщение об ошибках на английском
		catch (\Exception $e) 
		{
			return Redirect::action('App\Controllers\Admin\UsersController@getCreate')->withErrors(array('register' => $e->getMessage()));
		}

		/*catch (Cratalyst\Sentry\Users\UserExistsException $e)
		{
			echo "User already exist";
		}*/
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /user
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /user/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$user = Sentry::getUserProvider()->findById($id);

		return View::make('admin/users/edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit($id)
	{
		try
		{

			$rules = array(
				'first_name'       => 'required|min:3',
				'last_name'        => 'required|min:3',
				'email'            => 'required|email',
			);

			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails())
			{
				// Ooops.. something went wrong
				return Redirect::action('App\Controllers\Admin\UsersController@getEdit', array('id'=> $id))->withInput()->withErrors($validator);
			}


			try
			{
			    // Find the user using the user id
			    $user = Sentry::findUserById($id);

			    // Update the user details
			    $user->email = Input::get('email');
			    $user->first_name = Input::get('first_name');
			    $user->last_name = Input::get('last_name');

			    // Update the user
			    if ($user->save())
			    {
			        // User information was updated
			        return Redirect::action('App\Controllers\Admin\UsersController@getIndex')->with(array('success' => 'Ифнормация о пользователе успешно изменена'));
			    }
			    else
			    {
			        // User information was not updated
			        return Redirect::action('App\Controllers\Admin\UsersController@getEdit', array('id'=> $id))->withErrors(array('edit' => $e->getMessage()));
			    }
			}
			catch (Cartalyst\Sentry\Users\UserExistsException $e)
			{
			    return Redirect::action('App\Controllers\Admin\UsersController@getEdit', array('id'=> $id))->withErrors(array('edit' => $e->getMessage()));
			    //echo 'User with this login already exists.';
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
			    return Redirect::action('App\Controllers\Admin\UsersController@getEdit', array('id'=> $id))->withErrors(array('edit' => $e->getMessage()));
			    
			    //echo 'User was not found.';
			}

		}
		//Сообщение об ошибках на английском
		catch (\Exception $e) 
		{
			return Redirect::action('App\Controllers\Admin\UsersController@getCreate')->withErrors(array('register' => $e->getMessage()));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($id)
	{
		try
		{
		    // Find the user using the user id
		    $user = Sentry::findUserById($id);
		    // Delete the user
		    $user->delete();

		    return Redirect::action('App\Controllers\Admin\UsersController@getIndex')->with(array('success' => 'Пользователь успешно удален!'));

		}    			
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			    return Redirect::action('App\Controllers\Admin\UsersController@getIndex')->withErrors(array('delete' => $e->getMessage()));
		}
	}

}