<?php

class UserController extends BaseController
{
	//gets the view for the register page
	public function getCreate()
	{
		return View::make('users.create');
	}

	//gets the view for the login page
	public function getLogin()
	{
		return View::make('users.login');
	}

	public function postCreate()
	{
		$validate = Validator::make(Input::all(), array(
			'email' => 'required|email|unique:users',
			'pass1' => 'required|min:6',
			'pass2' => 'required|same:pass1',
		));

		if ($validate->fails())
		{
			return Redirect::route('getCreate')->withErrors($validate)->withInput();
		}
		else
		{
			$user = new User();
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('pass1'));

			if ($user->save())
			{
				//return Redirect::route('home')->with('success', 'You registed successfully. You can now login.');
				return Redirect::route('getLogin')->with('message', array('type' => 'success', 'content' => '注册成功，请登录'));

				//return Redirect::to('login')->withInput()->with('message', 'E-mail or password error');
			
			}
			else
			{
				//return Redirect::route('home')->with('fail', 'An error occured while creating the user. Please try again.');
				return Redirect::route('getCreate')->withInput()->with('message', array('type' => 'danger', 'content' => '注册失败'));
			}
		}
	}

	public function postLogin()
	{
		$validator = Validator::make(Input::all(), array(
		'email' => 'required',
		'pass1' => 'required'
		));
		
		if($validator->fails())
		{
			return Redirect::route('getLogin')->withErrors($validator)->withInput();
		}
		else
		{
			$remember = (Input::has('remember')) ? true : false;

			$auth = Auth::attempt(array(
				'email' => Input::get('email'),
				'password' => Input::get('pass1')
				), $remember);

			if($auth)
			{
				return Redirect::intended('/');
			}
			else
			{
				//return Redirect::route('getLogin')->with('fail', 'You entered the wrong login credentials, please try again!');
				return Redirect::route('getLogin')->withInput()->with('message', array('type' => 'danger', 'content' => 'E-mail或者密码错了，请再试一次'));
			}
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::route('home');
	}
}