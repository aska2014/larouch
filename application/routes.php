<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/


/*
| Route pages
|------------
| /page/about-us-1.html
*/
Route::get('page/(:any).html', function($title_en)
{
	return MyView::make('pages.master')->with('page', Page::where_title_en(str_replace("-", " ", $title_en))->first());	
});

// baklawa/chocolate5-overview.html :: product
// arabic-pasteries-10.html         :: Category
// arabic-pasteries/baklawa-20.html :: Subcategories
Route::get('(:any)/(:any)-overview(:num).html', array('as' => 'product', 'uses' => 'product@index'));
Route::get('(:any)-(:num).html', array('as' => 'overview', 'uses' => 'overview@category'));
Route::get('(:any)/(:any)-(:num).html', array('as' => 'overview', 'uses' => 'overview@subcategory'));

Route::any('shopping-cart', array('as' => 'shopping_cart', 'uses' => 'shopping_cart@index'));

Route::post('register', array('uses' => 'login@register'));
Route::get('register', array('uses' => 'login@index'));

Route::get('logout',function()
{
	Auth::logout();
	return Redirect::back();
});

/*
| Setting languages
|-------------------
*/

Route::get('set_language/arabic', function()
{
	Session::put('lan', 'ar');
	return Redirect::back();
});

Route::get('set_language/english', function()
{
	Session::put('lan', 'en');
	return Redirect::back();
});

/*
 * Control panel Routes
 */

Route::get('larouch2012', function()
{
	return Redirect::to('larouch2012/products');
});

Route::get('larouch2012/logout',function()
{
	Auth::logout();
	return Redirect::to('larouch2012/login');
});

Route::get('larouch2012/help/(:any)', function($page)
{
	return View::make('c.help.master')->with('page'        , $page)
									  ->with('main_active' , 'Help')
									  ->with('sub_active'  , ucfirst($page))
									  ->with('errors'      , null);
});

/*
 *-----------------------------------------------------------------------
 */

Route::controller(Controller::detect());

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});

Route::filter('cart_empty', function()
{
	if(Cart::total_items() == 0)
	{
		if(Session::get('lan') == "ar")
		{
			return MyView::make('message.master')->with('message', '<a href="'.URL::home().'">اضغط هنا للذهاب للصفحة الرئيسية و تكملة التسوق</a>')
											   ->with('title', 'لا يوجد لديك اى منتجات فى سلة المشتريات');
		
		}
		else
		{
			return MyView::make('message.master')->with('message', '<a href="'.URL::home().'">Click here to go home and continue shopping</a>')
											   ->with('title', 'You don\'t have any items in your cart yet');
		}
	}
});

Route::filter('admin_auth', function()
{
	$editor_access  = array('products', 'slider', 'categories', 'orders', 'pages', 'subcategories', 'admins', 'quality');
	$checker_access = array('orders');
	
	if(AdminAuth::guest())
		return Redirect::to('larouch2012/login');
	
	else if(AdminAuth::editor()  && !in_array(URI::segment(2), $editor_access))
		return Redirect::to('larouch2012/'.$editor_access[0]);

	else if(AdminAuth::checker() && !in_array(URI::segment(2), $checker_access))
		return Redirect::to('larouch2012/'.$checker_access[0]);
});