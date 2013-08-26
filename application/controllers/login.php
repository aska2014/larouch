<?php

class Login_Controller extends Base_Controller{

	public $restful = true;

	public function get_index()
	{
		if(!Auth::guest())return Redirect::back();
		
		return MyView::make('login.master');
	}

	/*
	 * Login form is submitted
	 */
	public function post_index()
	{
		$input = Input::all();
		$remember = false;
		if(isset($input['remember']))$remember = true;

		if(isset($input['email']) && isset($input['password']))
		{
			$credentials = array('username' => $input['email'], 
								 'password' => $input['password'],
								 'remember' =>$remember);
			if(Auth::attempt($credentials))
			{
				return Redirect::home();
			}
			else
			{
				$view = $this->get_index();
				$view->login_errors = 'Email and/or password are incorrect';
				return $view;
			}
		}
	}


	/*
	 * Register form is submitted
	 */
	public function post_register()
	{
		/*
		 * Validation of inputs
		 */
		$input = Input::all();
		$rules = array(
			'first_name' => 'required|min:3',
			'last_name' => 'required|min:3',
			'email' => 'required|unique:members|email',
			'password' => 'required|min:7',
			're_password' => 'same:password'
			);
		$validation = Validator::make($input, $rules);
		if($validation->fails())
		{
			return Redirect::to('login')->with_errors($validation);
		}
		$remember = false;
		if(isset($input['remember']))$remember = true;

		/*
		 * Creating a new member
		 */
		$member = new Member;
		$member->first_name = $input['first_name'];
		$member->last_name = $input['last_name'];
		$member->email = $input['email'];
		$member->password = Hash::make($input['password']);
		if(!$member->save())return 'This is unusual but something gone wrong with the database, Please try again and sorry for the inconvenience';

		/*
		 * Logging in the new member
		 */
		$credentials = array('username' => $input['email'], 
							 'password' => $input['password'],
							 'remember' =>$remember);
		if(Auth::attempt($credentials))
		{
			return Redirect::home();
		}

	}

}