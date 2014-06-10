<?php

class AuthController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function getRegister()
	{
		if (Sentry::check())
		{
		    return Redirect::to('admin');
		}
		else
		{
		    return View::make('auth.register');
		}

	}

	public function getLogin()
	{
		return View::make('auth.login');
	}

	public function postRegister()
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
			return Redirect::to('register')->withInput()->withErrors($validator);
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
				return Redirect::to('login')->with(array('success' => 'Вы успшено зарегистрованые! Зайдите в систему!'));
			}
		}		

		//Сообщение об ошибках на английском
		catch (\Exception $e) 
		{
			return Redirect::to('register')->withErrors(array('register' => $e->getMessage()));
		}

		/*catch (Cratalyst\Sentry\Users\UserExistsException $e)
		{
			echo "User already exist";
		}*/
	}

	public function postLogin()
	{
		$credentials = array(
			'email' => Input::get('email'),
			'password' => Input::get('password'),
			);

		$rules = array(
			'email'    => 'required|email',
			'password' => 'required|between:3,32',
		);

		$validator = Validator::make(Input::all(), $rules);


		if ($validator->fails())
		{
			return Redirect::to('login')->withErrors(array('login' => 'Данные введены не верно! Проверьте E-mail или пароль.'));
		}

		try
		{
			$user = Sentry::authenticate($credentials, Input::get('remember-me', 0));

			if($user)
			{
				return Redirect::to('admin');
			}
		}

		/*Сообщение об ошибках на английском
		catch (\Exception $e) 
		{
			return Redirect::to('login')->withErrors(array('login' => $e->getMessage()));
		}*/
	
		//Перевод всех перехватов
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    return Redirect::to('login')->withErrors(array('login' => 'Незаполнено поле E-mail'));
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    return Redirect::to('login')->withErrors(array('login' => 'Незаполнено поле пароль'));
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
		    return Redirect::to('login')->withErrors(array('login' => 'Неверный пароль'));
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::to('login')->withErrors(array('login' => 'Пользователь с таким E-mail не существует'));
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		    return Redirect::to('login')->withErrors(array('login' => 'Пользователь не активирован'));
		}
	}

	public function getLogout()
	{
		Sentry::logout();
		return Redirect::to('/');
	}

}
