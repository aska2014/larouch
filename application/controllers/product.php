<?php

class Product_Controller extends Base_Controller{

	function action_index($subcategory, $title, $id = 1)
	{
		$view = MyView::make('product.master');

		$view->product = Product::find($id);
		$view->related = $view->product->getRelated();
		$view->category = $view->product->subcategory->category;
		$view->subcategory = $view->product->subcategory;

		//Validating the URL For Duplicating pages -- SEO --
		if(str_replace(" ", "-", $view->subcategory->title_en) != $subcategory)
			Event::fire('loaded');

		return $view;
	}
}