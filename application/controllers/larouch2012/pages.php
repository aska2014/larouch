<?php

class Larouch2012_Pages_Controller extends Base_Controller{

	public $restful = true;

	public function get_add($errors = null)
	{
		$view = View::make('c.pages.master');

		$view->main_active = "Pages";
		$view->sub_active = "Add new page";
		$view->display = "add";
		$view->errors = $errors;

		return $view;
	}

	public function get_edit($page_id = 0 , $errors = null)
	{
		$view = View::make('c.pages.master');

		$view->main_active = "Pages";
		$view->sub_active = "Edit page";
		$view->display = "edit";
		$view->page = Page::find($page_id);
		$view->errors = $errors;

		return $view;
	}

	public function get_manage($errors = null)
	{
		$view = View::make('c.pages.master');

		$view->main_active = "Pages";
		$view->sub_active = "Manage pages";
		$view->display = "manage";
		$view->pages = Page::order_by('created_at', 'desc')->paginate(10);
		$view->errors = $errors;

		return $view;
	}

	//---------------------------------------------------------------------------------\\

	/*
	 * Add new page form is submitted
	 */
	public function post_add($page_id = 0)
	{
		$input = Input::all();
		$rules = array(
			'title_en' => 'required',
			'title_ar' => 'required',
			'content_en' => 'required',
			'content_en' => 'required');

		$validation = Validator::make($input, $rules);
		if($validation->fails())
		{
			return $this->get_add($validation->errors->all());
		}
		else
		{
			if($page_id == 0)
				$page = new Page;
			else
				$page = Page::find($page_id);
			$page->title_en = $input['title_en'];
			$page->title_ar = $input['title_ar'];
			$page->content_en = $input['content_en'];
			$page->content_ar = $input['content_ar'];
			$page->save();

			if($page_id == 0)
				$view = $this->get_add();
			else
				$view = $this->get_edit($page_id);
			$view->success = true;
			return $view;
		}
	}

	/*
	 * Edit page form is submitted
	 */
	public function post_edit($page_id = 0)
	{
		if(!is_null(Page::find($page_id)))
			return $this->post_add($page_id);
	}

	/*
	 * Call this function while sending the category id as a POST variable
	 */
	public function post_delete()
	{
		if(isset($_POST['page_id']))
		{
			$category = Page::find($_POST['page_id']);
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
			$category = Page::find($ids[$i]);
			$category->_order = $orders[$i];
			$category->save();
		}
		return Redirect::to('larouch2012/pages/manage');
	}

}