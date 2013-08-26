<?php

class Larouch2012_Subcategories_Controller extends Base_Controller{

	public $restful = true;

	public function __construct()
	{
		$this->filter('before', 'admin_auth');
	}

	public function get_index($errors = null){return $this->get_add($errors);}
	public function post_index(){return $this->post_add();}


	/*
	 * Adding new subcategory
	 */
	public function get_add($errors = null)
	{
		$view = View::make('c.subcategories.master');

		$view->main_active = "SubCategories";
		$view->sub_active = "Add new subcategory";
		$view->errors = $errors;
		$view->page = "add";
		$view->categories = Category::all();

		return $view;
	}

	/*
	 * Editing subcategory passing the subcategory id as the first argument
	 */
	public function get_edit($subcategory_id = 0, $errors = null)
	{
		$view = View::make('c.subcategories.master');

		$view->main_active = "SubCategories";
		$view->sub_active = "Add new subcategory";
		$view->errors = $errors;
		$view->page = "edit";
		if(is_null($view->subcategory = Subcategory::find($subcategory_id)))
			return Response::error('404');
		$view->categories = Category::all();

		return $view;
	}

	/*
	 * Managing subcategories
	 */
	public function get_manage($errors = null)
	{
		$view = View::make('c.subcategories.master');

		$view->main_active = "SubCategories";
		$view->sub_active = "Manage subcategories";
		$view->errors = $errors;
		$view->page = "manage";
		$view->subcategories = Subcategory::order_by('_order','desc')->paginate(10);

		return $view;
	}

	//------------------------------------------------------------------------------------------\\

	/*
	 * When adding form is submitted this will be called
	 * When editing form is submitted we will check for the subcategory id and call this
	 */
	public function post_add($subcategory_id = 0)
	{
		$input = Input::all();
		$rules = array(
			'title_en' => 'required',
			'title_ar' => 'required',
			'category_id' => 'required|exists:categories,id');
 	    	
		$validation = Validator::make($input, $rules);
		if($validation->fails())
		{
			return $this->get_add($validation->errors->all());
		}
		else
		{
			if($subcategory_id == 0)
				$subcategory = new Subcategory;
			else
				$subcategory = Subcategory::find($subcategory_id);
			$subcategory->title_en = $input['title_en'];
			$subcategory->title_ar = $input['title_ar'];
			$subcategory->category_id = $input['category_id'];
			$subcategory->_order = Subcategory::max('_order') + 1;
			$subcategory->save();

			if($subcategory_id == 0)
				$view = $this->get_add();
			else
				$view = $this->get_edit($subcategory_id);
			$view->success = true;
			return $view;
		}
	}
	
	/*
	 * Edit form is submitted, this will call add after validating subcategory id
	 */
	public function post_edit($subcategory_id = 0)
	{
		$check = Subcategory::find($subcategory_id);
		if(!is_null($check))return $this->post_add($subcategory_id);
	}

	/*
	 * Call this function while sending the subcategory id as a POST variable
	 */
	public function post_delete()
	{
		if(isset($_POST['subcategory_id']))
		{
			$subcategory = Subcategory::find($_POST['subcategory_id']);
			$subcategory->delete();
		}
	}

	/*
	 * Called when update orders button is clicked
	 * Don't miss with it, it works just fine
	 */
	public function post_order()
	{
		$orders = $_POST['order'];
		$ids = $_POST['id'];
		
		for($i = 0;$i < count($orders);$i++)
		{
			$subcategory = Subcategory::find($ids[$i]);
			$subcategory->_order = $orders[$i];
			$subcategory->save();
		}
		return Redirect::to('larouch2012/subcategories/manage');
	}
}