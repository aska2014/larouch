<?php


class Test_Controller extends Controller{

	function action_test()
	{
		echo Session::get('kareem');
		exit();

		foreach (Cart::contents() as $key => $value) {
			var_dump($value);
			echo '<Br /><br />';
		}
		exit();
	}

}