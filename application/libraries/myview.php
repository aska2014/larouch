<?php

class MyView extends View{


	/*
	|
	| Defining Constant variables between all views
	|
	*/
	static public function make($view, $data = array())
	{
		$myview = parent::make($view, $data);
		
		$myview->lan                  = "ar";
		$myview->menu                 = Page::order_by('_order', 'desc')->get();
		$myview->menu_categories      = Category::all();
		$myview->footer_subcategories = Subcategory::skip((int)rand(1,(Subcategory::count() - 4)))->take(3)->get();

		return $myview;
	}

}