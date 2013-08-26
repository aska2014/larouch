<?php

class Larouch2012_Quality_Controller extends Base_Controller{

	public $restful = true;

	public function __construct()
	{
		$this->filter('before', 'admin_auth');
	}

	public function get_index($errors = null){return $this->get_edit($errors);}
	public function post_index(){return $this->post_edit();}

	/*
	 * Editing category passing the category id as the first argument
	 */
	public function get_edit($errors = null)
	{
		$view = View::make('c.quality.master');

		$view->main_active = "Quality";
		$view->sub_active = "Edit Quality Guarantee";
		$view->errors = $errors;
		$products = Product::all();
		$view->product = $products[0];

		return $view;
	}

	//------------------------------------------------------------------------------------------\\

	public function post_edit()
	{
		$input = Input::all();
		
		DB::query('UPDATE products SET quality_en = ?, quality_ar = ?', array($input['quality_en'], $input['quality_ar']));

		$view = $this->get_edit();
		$view->success = true;
		return $view;
	}
}