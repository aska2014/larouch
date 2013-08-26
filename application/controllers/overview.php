<?php

class Overview_Controller extends Base_Controller{

	function action_category($category, $category_id)
	{
		$view = MyView::make('overview.master');

		$view->subcategories = Subcategory::where('category_id', '=' ,$category_id)->paginate(2);
		$view->category = Category::find($category_id);
		$view->subcategory = '';

		return $view;
	}

	function action_subcategory($category, $subcategory, $subcategory_id)
	{
		$view = MyView::make('overview.master');

		$view->m_products = Product::where('subcategory_id', '=' , $subcategory_id)
									->order_by('created_at','desc')->paginate(8);
		$view->subcategory = Subcategory::find($subcategory_id);

		return $view;
	}

}