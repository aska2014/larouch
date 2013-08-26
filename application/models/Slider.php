<?php

class Slider extends Eloquent {

	/*
	 *	GET slider Image if exists or return default image
	 */
	public function img($fix = "")
	{
		if(file_exists(path('public').'/albums/sliders'.$fix.'/slider'.$this->id.'.jpg'))
			return URL::to('public/albums/sliders'.$fix.'/slider'.$this->id.'.jpg');
		else
			return URL::to('public/albums/sliders'.$fix.'/default.jpg');
	}
	
	public function url()
	{
		return $this->link;
	}
	
}