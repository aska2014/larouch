<?php

class Larouch2012_Slider_Controller extends Base_Controller{

	public $restful = true;

	public function __construct()
	{
		$this->filter('before', 'admin_auth');
	}

	public function get_index($errors = null){return $this->get_add($errors);}
	public function post_index(){return $this->post_add();}

	/*
	 * Adding new Slider
	 */
	public function get_add($errors = null)
	{
		$view = View::make('c.sliders.master');

		$view->main_active = "Slider";
		$view->sub_active = "Add new slider";
		$view->errors = $errors;
		$view->page = "add";

		return $view;
	}

	/*
	 * Editing category passing the category id as the first argument
	 */
	public function get_edit($slider_id = 0, $errors = null)
	{
		$view = View::make('c.sliders.master');

		$view->main_active = "Sliders";
		$view->sub_active = "Add new slider";
		$view->errors = $errors;
		$view->page = "edit";
		if(is_null($view->slider = Slider::find($slider_id)))
			return false;

		return $view;
	}

	/*
	 * Managing categories
	 */
	public function get_manage($errors = null)
	{
		$view = View::make('c.sliders.master');

		$view->main_active = "Slider";
		$view->sub_active = "Manage Sliders";
		$view->errors = $errors;
		$view->page = "manage";
		$view->sliders = Slider::order_by('created_at','desc')->paginate(10);

		return $view;
	}

	//------------------------------------------------------------------------------------------\\

	/*
	 * When adding form is submitted this will be called
	 * When editing form is submitted we will check for the product id and call this
	 */
	public function post_add($slider_id = 0)
	{
		$main_image_required = '';
		if($slider_id == 0)
			$main_image_required = 'required|';
		$input = Input::all();
		$rules = array(
			'main_image' => $main_image_required.'max:3000');
 	    	
		$validation = Validator::make($input, $rules);
		if($validation->fails())
		{
			if($slider_id == 0)
				return $this->get_index($validation->errors->all());
			else
				return $this->get_edit ($slider_id,$validation->errors->all());	
		}
		else
		{
			if($slider_id == 0)
				$slider = new Slider;
			else
				$slider = Slider::find($slider_id);
			$slider->link = $input['link'];
			$slider->save();

			// Image Upload
			if($input['main_image']['error'] == "0")
			{
				$image = new SimpleImage($input['main_image']['tmp_name']);
				
				$image->resize_crop(938,398);
				$image->save( 'sliders/slider'.$slider->id.'.jpg');
				
				$image->resize_crop(100,60);
				$image->save( 'sliders_th/slider'.$slider->id.'.jpg');
			}
			////////////////////////////////////////////////////////


			if($slider_id == 0)
				$view = $this->get_add();
			else
				$view = $this->get_edit($slider_id);
			$view->success = true;
			return $view;
		}
	}
	
	/*
	 * Edit form is submitted, this will call add after validating category id
	 */
	public function post_edit($slider_id = 0)
	{
		$check = Slider::find($slider_id);
		if(!is_null($check))return $this->post_add($slider_id);
	}

	/*
	 * Call this function while sending the category id as a POST variable
	 */
	public function post_delete()
	{
		if(isset($_POST['slider_id']))
		{
			$slider = Slider::find($_POST['slider_id']);
			unlink(path('public').'albums/sliders/slider'.$slider->id.'.jpg');
			unlink(path('public').'albums/sliders_th/slider'.$slider->id.'.jpg');
			$slider->delete();

		}
	}
}