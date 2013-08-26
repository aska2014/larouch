<?php

class Larouch2012_Products_Controller extends Base_Controller{

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
		$view = View::make('c.products.master');

		$view->main_active = "Products";
		$view->sub_active = "Add new product";
		$view->categories = Category::all();
		$view->errors = $errors;
		$view->page = "add";

		return $view;
	}

	/*
	 * Editing category passing the category id as the first argument
	 */
	public function get_edit($product_id = 0, $errors = null)
	{
		$view = View::make('c.products.master');

		$view->main_active = "Products";
		$view->sub_active = "Add new product";
		$view->categories = Category::all();
		$view->errors = $errors;
		$view->page = "edit";
		if(is_null($view->product = Product::find($product_id)))
			return false;

		return $view;
	}

	/*
	 * Managing categories
	 */
	public function get_manage($errors = null)
	{
		$view = View::make('c.products.master');

		$view->main_active = "Products";
		$view->sub_active = "Manage Products";
		$view->errors = $errors;
		$view->page = "manage";
		$view->products = Product::order_by('created_at','desc')->paginate(10);

		//For searching
		$view->search_products = Product::all();
		$view->search_categories = Category::all();
		$view->search_subcategories = Subcategory::all();

		return $view;
	}

	//------------------------------------------------------------------------------------------\\


	/**
	 * Search products by categories, subcategories and products
	 */
	public function post_search()
	{
		$view = $this->get_manage();
		if($_POST['subcategory_id'] != '')
		{
			$view->products = Subcategory::find($_POST['subcategory_id'])->products()->paginate(10);
		}
		else if($_POST['product_id'] != '')
		{
			$view->products = Product::where_id($_POST['product_id'])->paginate(10);
		}
		return $view;
	}

	/*
	 * When adding form is submitted this will be called
	 * When editing form is submitted we will check for the product id and call this
	 */
	public function post_add($product_id = 0)
	{
		if($product_id == 0)$main_image_required = 'required|';
		else $main_image_required = '';
		
		$input = Input::all();
		$rules = array(
			'title_en' => 'required',
			'title_ar' => 'required',
			'price' => 'numeric',
			'category_id' => 'required',
			'subcategory_id' => 'required',
			'main_image' => $main_image_required.'max:3000');
 	    	
		$validation = Validator::make($input, $rules);
		if($validation->fails())
		{
			if($product_id == 0)
				return $this->get_index($validation->errors->all());
			else
				return $this->get_edit ($product_id,$validation->errors->all());	
		}
		else
		{
			if($product_id == 0)
				$product = new Product;
			else
				$product = Product::find($product_id);
			$product->title_en = $input['title_en'];
			$product->title_ar = $input['title_ar'];
			$product->price = $input['price'];
			$product->type = $input['type'];
			$product->subcategory_id = $input['subcategory_id'];
			$product->save();


			// Image Upload
			if($input['main_image']['error'] == "0")
			{
				$image = new SimpleImage($input['main_image']['tmp_name']);
				$image->save('products_no/product'.$product->id.'.jpg');

				$image->resize_crop(635,371);
				$image->save( 'products/product'.$product->id.'.jpg');

				$image->resize_crop(220,120);
				$image->save( 'products_sp/product'.$product->id.'.jpg');

				$image->resize_crop(205,143);
				$image->save( 'products_th/product'.$product->id.'.jpg');
			}
			////////////////////////////////////////////////////////


			/* Finished uploading images */
			if($product_id == 0)
				$view = $this->get_add();
			else
				$view = $this->get_edit($product_id);
			$view->success = true;
			return $view;
		}
	}
	
	/*
	 * Edit form is submitted, this will call add after validating category id
	 */
	public function post_edit($product_id = 0)
	{
		$check = Product::find($product_id);
		if(!is_null($check))return $this->post_add($product_id);
	}

	/*
	 * Call this function while sending the category id as a POST variable
	 */
	public function post_delete()
	{
		if(isset($_POST['product_id']))
		{
			$product = Product::find($_POST['product_id']);
			unlink(path('public').'albums/products/product'.$product->id.'.jpg');
			unlink(path('public').'albums/products_th/product'.$product->id.'.jpg');
			$product->delete();

		}
	}
}