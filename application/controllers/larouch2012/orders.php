<?php

class Larouch2012_Orders_Controller extends Base_Controller{

	public $restful = true;

	public function __construct()
	{
		$this->filter('before', 'admin_auth');
	}

	public function get_index($errors = null){return $this->get_manage($errors);}

	/**
	 * Getting print view of order
	 */
	public function get_show($order_id = 0)
	{
		$view = View::make('c.orders.show');

		$view->order = Order::find($order_id);
		if(empty($view->order))
			return Redirect::to('larouch2012/orders');

		return $view;
	}

	/*
	 * Editing order passing the order id as the first argument
	 */
	public function get_edit($order_id = 0, $errors = null)
	{
		$view = View::make('c.orders.edit');

		$view->main_active = "Orders";
		$view->sub_active  = "Add new order";
		$view->errors      = $errors;
		$view->page        = "edit";
		$view->order       = Order::find($order_id);
		if(empty($view->order))
			return Redirect::to('larouch2012/orders');

		if($view->order->stage != Auth::user()->admin_type)
			return Redirect::to('larouch2012/orders/show/'.$order_id);

		return $view;
	}

	/**
	 * Managing orders
	 */
	public function get_manage($errors = null)
	{
		$view = View::make('c.orders.master');

		$view->main_active = "Orders";
		$view->sub_active  = "Manage orders";
		$view->errors      = $errors;
		$view->page        = "manage";
		$view->orders      = Order::order_by('created_at','desc')->paginate(10);

		return $view;
	}

	/**
	 * Displaying archied orders
	 */
	public function get_display()
	{
		$view = View::make('c.orders.master');

		$view->main_active = "Orders";
		$view->sub_active = "Display archived orders";
		$view->errors = null;
		$view->page = "display";
		$view->orders = Order::where('stage', '>', Auth::user()->admin_type)->order_by('created_at','desc')->paginate(10);

		$view->statistics = Statistics::weekly();
		$view->members    = Member::where('type', '!=', 'admin')->get();

		return $view;
	}

	/**
	 * Adding new Product in the order with id $order_id
	 */
	public function get_add_product($order_id, $errors = null)
	{
		$view = View::make('c.orders.master');

		$view->main_active = "Orders";
		$view->sub_active  = "";
		$view->errors      = $errors;
		$view->page        = "add_product";
		$view->order       = Order::find($order_id);
		$view->categories  = Category::all();

		return $view;
	}

	public function get_accept($order_id)
	{
		$order = Order::find($order_id);
		$order->accept();
		return Redirect::to('larouch2012/orders/manage');
	}

	public function get_finished($order_id)
	{
		$order = Order::find($order_id);
		$order->finish();
		return Redirect::to('larouch2012/orders/manage');
	}

	//------------------------------------------------------------------------------------------\\

	/*
	 * Search accepted or finished orders 
	 */
	public function post_search()
	{
		if($_POST['member_email'] != '' || $_POST['member_name'] != '')
		{
			$member_id = ($_POST['member_email'] == '')? $_POST['member_name']:$_POST['member_email'];
			$view = $this->get_display();
			$view->member_search = Member::find($member_id);
			$view->orders = Order::where_member_id($member_id)->paginate(10);
			return $view;
		}
		else
		{
			return Redirect::to('larouch2012/orders/display');
		}

	}


	/*
	 * When adding form is submitted this will be called
	 * When editing form is submitted we will check for the order id and call this
	 */
	public function post_edit($order_id)
	{
		$input = Input::all();
		
		$order = Order::find($order_id);
		
		$order->member->first_name = $input['first_name'];
		$order->member->last_name  = $input['last_name'];
		$order->member->email      = $input['email'];

		$order->address            = $input['address'];
		$order->phone              = $input['phone'];
		$order->deliver_at         = date('Y-m-d',strtotime($input['deliver_at']));
		$order->deliver_range      = $input['deliver_range'];

		for ($i = 0; $i < count($input['product_ids']); $i++) { 
			
			$order_product        = Intermediate::find($input['intermediate_ids'][$i]);
			if($order_product)
			{
				$order_product->qty   = $input['qtys'][$i];
				$order_product->price = $input['prices'][$i];

				if(isset($input['removes'][$i]))
					$order_product->delete();
				else
					$order_product->save();
			}
		}

		$order        ->save();
		$order->member->save();

		$view = $this->get_edit($order_id);
		$view->success = true;
		return $view;
	}

	/**
	 * Add new product in this order
	 */
	public function post_add_product($order_id)
	{
		$product = Product::find($_POST['product_id']);
		$product->orders()->attach($order_id, array('qty'   => isset($_POST['quantity'])? $_POST['quantity']:0,
													'price' => $product->price));
		
		$view = $this->get_add_product($order_id);
		$view->success = true;
		return $view;
	}

	/*
	 * Call this function while sending the order id as a POST variable
	 */
	public function post_delete()
	{
		if(isset($_POST['order_id']))
		{
			$order = Order::find($_POST['order_id']);
			$order->delete();
		}
	}
}