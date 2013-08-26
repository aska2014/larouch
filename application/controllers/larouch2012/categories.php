<?php

class Larouch2012_Categories_Controller extends Base_Controller{

	public $restful = true;

	public function __construct()
	{
		$this->filter('before', 'admin_auth');
	}

	public function get_index($errors = null){return $this->get_add($errors);}
	public function post_index(){return $this->post_add();}


	/*
	 * Adding new category
	 */
	public function get_add($errors = null)
	{
		$view = View::make('c.categories.master');

		$view->main_active = "Categories";
		$view->sub_active = "Add new category";
		$view->errors = $errors;
		$view->page = "add";

		return $view;
	}

	/*
	 * Editing category passing the category id as the first argument
	 */
	public function get_edit($category_id = 0, $errors = null)
	{
		$view = View::make('c.categories.master');

		$view->main_active = "Categories";
		$view->sub_active = "Add new category";
		$view->errors = $errors;
		$view->page = "edit";
		if(is_null($view->category = Category::find($category_id)))
			return Response::error('404');

		return $view;
	}

	/*
	 * Managing categories
	 */
	public function get_manage($errors = null)
	{
		$view = View::make('c.categories.master');

		$view->main_active = "Categories";
		$view->sub_active = "Manage categories";
		$view->errors = $errors;
		$view->page = "manage";
		$view->categories = Category::order_by('_order','desc')->paginate(10);

		return $view;
	}

	//------------------------------------------------------------------------------------------\\

	/*
	 * When adding form is submitted this will be called
	 * When editing form is submitted we will check for the category id and call this
	 */
	public function post_add($category_id = 0)
	{
		$input = Input::all();
		$rules = array(
			'title_en' => 'required',
			'title_ar' => 'required');
 	    	
		$validation = Validator::make($input, $rules);
		if($validation->fails())
		{
			return $this->get_add($validation->errors->all());
		}
		else
		{
			if($category_id == 0)
				$category = new Category;
			else
				$category = Category::find($category_id);
			$category->title_en = $input['title_en'];
			$category->title_ar = $input['title_ar'];
			$category->_order = Category::max('_order') + 1;
			$category->save();

			if($category_id == 0)
				$view = $this->get_add();
			else
				$view = $this->get_edit($category_id);
			$view->success = true;
			return $view;
		}
	}
	
	/*
	 * Edit form is submitted, this will call add after validating category id
	 */
	public function post_edit($category_id = 0)
	{
		$check = Category::find($category_id);
		if(!is_null($check))return $this->post_add($category_id);
	}

	/*
	 * Call this function while sending the category id as a POST variable
	 */
	public function post_delete()
	{
		if(isset($_POST['category_id']))
		{
			$category = Category::find($_POST['category_id']);
			$category->delete();
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
			$category = Category::find($ids[$i]);
			$category->_order = $orders[$i];
			$category->save();
		}
		return Redirect::to('larouch2012/categories/manage');
	}
}