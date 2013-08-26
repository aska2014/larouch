<?php

class Page extends Eloquent{

	public function url()
	{
		return URL::to('page/'.str_replace(" ", "-", $this->title_en).'.html');
	}

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