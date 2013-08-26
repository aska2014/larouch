<?php

class Home_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
		$view = MyView::make('home.master');
		
		//$view->slider = Product::where('type', '=', 'slider')->order_by('created_at', 'desc')->take(4)->get();
		$view->slider = Slider::order_by('created_at', 'desc')->take(4)->get();
		$view->main_products = Product::order_by('created_at', 'desc')->paginate(9);
		
		$view->specials = Product::where('type','=','specials')->order_by('created_at', 'desc')->get();
		$view->categories = Category::order_by('_order', 'desc')->get();

		return $view;
	}

	public function get_search() {
		$view = $this->get_index();

		$view->main_products = Product::search($_GET['s']);

		return $view;
	}

	public function post_index()
	{
		if(isset($_POST['product_id']) && isset($_POST['status']))
		{
			// Validation
			if($_POST['product_id'] != strval(intval($_POST['product_id'])))
			{
				exit();
			}

			//Check status to "add to cart" or "remove from cart"
			if($_POST['status'] == "add_to_cart")
			{
				$quantity = 1;
				if(isset($_POST['quantity']))
					$quantity = $_POST['quantity'];

				$product = Product::find($_POST['product_id']);
				$item = array(
				    'id'      => $_POST['product_id'],
				    'qty'     => $quantity,
				    'price'   => $product->price,
				    'name'    => $product->title_en
				);


				Cart::add( $item );
			}
			else if($_POST['status'] == "remove_from_cart")
			{
				Cart::remove(md5($_POST['product_id']));
			}
		}
	}
	
}