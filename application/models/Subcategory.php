<?php


class Subcategory extends Eloquent{

	/*
	| Defining Relationships
	|------------------------------------------------------------------
	*/
		public function category(){ return $this->belongs_to('Category'); }
		public function products(){ return $this->has_many('Product'); }
	/*
	|-----------------------------------------------------------------
	*/

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

	public function url()
	{
		$category = Category::find($this->category_id);
		return URL::to(str_replace(" ","-",$category->title_en).'/'.str_replace(" ","-",$this->title_en).'-'.$this->id.'.html');
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

}