<?php

class Product extends Eloquent{

	/*
	| Defining Relationships
	|------------------------------------------------------------------
	*/
		public function subcategory(){ return $this->belongs_to('Subcategory'); }
		public function orders(){ return $this->has_many_and_belongs_to('Order'); }
	/*
	|-----------------------------------------------------------------
	*/

	// Variables For the Cart
	public $qty;
	public $subtotal;

	/*
	| Define language and return the right attribute
	|-----------------------------------------------
	*/
	public function __get( $property )
	{
		if(!is_null(parent::__get($property)))
			return parent::__get($property);
		else
		{
			$lan = Session::get('lan');
			if(isset($lan)) $property .= '_'.$lan;
			else $property .= '_en';
			return $this->attributes[$property];
		}
	}
	/*
     * Returns Boolean
	 */
	public function inCart()
	{
		foreach (Cart::contents() as $value) {
			if($value['id'] == $this->id)
				return true;
		}
		return false;
	}
	/*
	 * Returns Array of objects
	 */
	public function getRelated()
	{
		$products = array();
		foreach($this->subcategory->category->subcategories as $subcategory)
			$products = array_merge($products, $subcategory->products);
		return $products;
	}

	/*
	 * GET link of product = subcategory/productTitleproductID-overview.html
	 */
	public function url()
	{
		$subcategory = Subcategory::find($this->subcategory_id, 'title_en');
		$subcategory_title = str_replace(" ","-",$subcategory->title_en);
		$product_title = explode(" ",$this->title_en);
		$product_title = (strlen($product_title[0]) > 2)? $product_title[0]:$product_title[1];
		prepareURL($subcategory_title);
		prepareURL($product_title);
		return URL::to($subcategory_title.'/'.$product_title.'-overview'.$this->id.'.html');
	}

	/*
	 *	GET product Image if exists or return default image
	 */
	public function img($fix = "")
	{
		if(file_exists(path('public').'/albums/products'.$fix.'/product'.$this->id.'.jpg'))
			return URL::to('public/albums/products'.$fix.'/product'.$this->id.'.jpg');
		else
			return URL::to('public/albums/products'.$fix.'/default.jpg');
	}

	/*
	 * Format price
	 */
	public function price()
	{
		return number_format($this->price, 2);
	}

	
	/**
	 * Override parent save and delete methods
	 */
	public function save()
	{
		if(AdminAuth::editor())
			return parent::save();
		return false;
	}
	public function delete()
	{
		if(AdminAuth::editor())
			return parent::delete();
		return false;
	}


	public function search($keyword = "") {
		return self::where('title_en', 'like', '%'.$keyword.'%')
					->or_where('title_ar', 'like', '%'.$keyword.'%')
					->order_by('created_at','DESC')
					->paginate(9);

	}

}