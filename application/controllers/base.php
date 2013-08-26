<?php

class Base_Controller extends Controller {
	
	function __construct()
	{
		$lan = Session::get('lan');
		if(!isset($lan))Session::put('lan', 'en');
	}

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

}