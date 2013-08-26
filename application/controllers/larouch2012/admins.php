<?php

class Larouch2012_Admins_Controller extends Base_Controller{

	public $restful = true;
	
	public function __construct()
	{
		$this->filter('before', 'admin_auth');
	}

	public function __call($method, $parameters)
	{
		return $this->get_index();
	}

	public function get_index($errors = null)
	{
		$view = View::make('c.admins.master');

		$view->main_active = "Admins";
		$view->sub_active = "Manage admins";
		$view->errors = $errors;
		$view->admins = Member::where('type' , '=' , 'admin')->paginate(10);

		return $view;
	}

	public function post_add()
	{
		$input = Input::all();
		$rules = array(
			'username' => 'required|unique:members,email',
			'password' => 'required|min:6'
			);
		$validation = Validator::make($input, $rules);
		if($validation->fails())
		{
			return $this->get_index($validation->errors->all());
		}
		else
		{
			$admin = new Member;
			$admin->email = $input['username'];
			$admin->password = Hash::make($input['password']);
			$admin->type = "admin";
			$admin->admin_type = 1;
			$admin->save();

			$view = $this->get_index();
			$view->success = true;
			return $view;
		}
	}

	public function post_update()
	{
		$admins_type = $_POST['admins_type'];
		$ids = $_POST['ids'];

		foreach($admins_type as $k => $type)
		{
			$admin = Member::find($ids[$k]);
			$admin->admin_type = $type;
			$admin->save();
		}
		$view = $this->get_index();
		$view->success = true;
		return $view;
	}

	public function post_delete()
	{
		if(isset($_POST['admin_id']))
		{
			$admin_id = $_POST['admin_id'];
			$admin = Member::find($admin_id);
			$admin->delete();
		}
	}
}