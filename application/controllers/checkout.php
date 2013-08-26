<?php

class Checkout_Controller extends Base_Controller{

	public $restful = true;

	public function __construct()
	{
		parent::__construct();
		$this->filter('before',array('auth','cart_empty'));	
	}

	public function get_index()
	{
		return MyView::make('checkout.master');
	}

	/*
	 * First step is submitted
	 * Updatting User information
	 */
	public function post_index()
	{
		$input = Input::all();
		$rules = array(
			'first_name' => 'required|min:3',
			'last_name' => 'required|min:3',
			'address' => 'required|min:4',
			'phone' => 'required|min:6',
			);
		$validation = Validator::make($input, $rules);

		if($validation->fails())
		{
			return Redirect::to('checkout')->with_errors($validation);
		}
		else
		{
			$member = Auth::user();
			$member->first_name = $input['first_name'];
			$member->last_name  = $input['last_name'];
			$member->address    = $input['address'];
			$member->phone      = $input['phone'];
			$member->save();
			
			$view = $this->get_index();
			$view->second = true;
			return $view;
		}

	}

	/*
	 * Second step is submitted
	 * Now ready to send order
	 */
	public function post_second()
	{
		$input = Input::all();
		$rules = array(
			'deliver_at' => 'required',
			'deliver_range' => 'required');
		$validation = Validator::make($input, $rules);
		if($validation->fails())
		{
			return Redirect::to('checkout')->with_errors($validation);
		}
		else
		{
			$user = Auth::user();

			$order = new Order;
			$order->member_id     = $user->id;
			$order->address       = $user->address;
			$order->phone         = $user->phone;
			$order->deliver_at    = date('Y-m-d', strtotime($input['deliver_at']));
			$order->deliver_range = $input['deliver_range'];
			$order->stage         = 1;
			$order->save();
			foreach (Cart::contents() as $value) {
				$product = Product::find($value['id']);
				$product->orders()->attach($order->id, array('qty'   => $value['qty'],
															 'price' => $value['price']));
			}

			Cart::destroy();

			if(Session::get('lan') == "ar")
			{
				$message = 'مرحبا, '.$user->name(). '<br /><br />';
				$message .= 'لقد تم إرسال الطلب بنجاح, سوف نتواصل معك فى أقرب وقت ممكن للتأكد من شخصيتك<br />';
				$message .= 'شكرا لإختيارنا.<br /><br />';
				$message .= 'إذا واجهتك أى مشكلة أثناء عملية الشراء يمكنك التواصل معنا <a href="'.URL::to('contact').'">من هنا</a>';
				return MyView::make('message.master')->with('message', $message)
												   ->with('title', 'شكرا لإختيارك شوكولا لاروش!');
			}
			else
			{
				$message = 'Hi, '.$user->name(). '<br /><br />';
				$message .= 'Your order has been placed successfully, we will call you as soon as possible to confirm your identity<br />';
				$message .= 'Thanks for choosing us.<br /><br />';
				$message .= 'If you had any problem while the checkout process please contact us <a href="'.URL::to('contact').'">from here</a>';
				return MyView::make('message.master')->with('message', $message)
												   ->with('title', 'Thanks for choosing Chocola Larouch!');
			}
		}
	}
}