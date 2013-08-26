<?php


class Shopping_cart_Controller extends Base_Controller{

	public $restful = true;

	public function get_index()
	{
		$products = array();
		foreach (Cart::contents() as $key => $value) {
			$products[$key] = Product::find($value['id']);
			$products[$key]->qty = $value['qty'];
			$products[$key]->subtotal = $value['subtotal'];
		}
		return MyView::make('shopping_cart.master')->with('products', $products);
	}

	public function post_index()
	{
		if(!isset($_POST['qty']))return $this->get_index();
		$items = array();
		foreach($_POST['qty'] as $key => $qty)
		{
			$item = array('rowid' => md5($_POST['ids'][$key]),
						  'qty' => $qty);
			array_push($items, $item);
		}
		Cart::update( $items );

		if(isset($_POST['remove']))
		{
			foreach($_POST['remove'] as $id)
			{
				Cart::remove(md5($id));
			}
		}

		if(isset($_POST['Checkout']))
			return Redirect::to('checkout');
		else
			return $this->get_index();
	}

}