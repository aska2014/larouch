<?php

class Larouch2012_Login_Controller extends Base_Controller{

	public $restful = true;

	public function get_index()
	{
		if(!AdminAuth::guest())
			return Redirect::to('larouch2012/products/add');
		return View::make('c.login.master');
	}

	public function post_index()
	{
		$input = Input::all();
		if(isset($input['username']) && isset($input['password']))
		{
			$remember = false;
			if(isset($input['remember']))$remember = true;
			$credentials = array('username' => $input['username'], 
								 'password' => $input['password'], 
								 'remember' => $remember);
			if(AdminAuth::attempt($credentials))
			{
				return Redirect::to('larouch2012/products/add');
			}
			else
			{
				return View::make('c.login.master')->with('login_errors', 'Email and/or password are incorrect');
			}
		}
	}
}