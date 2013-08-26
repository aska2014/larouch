<?php

class Intermediate extends Eloquent{
	
	public static $table = 'order_product';

	public function save()
	{
		if($this->qty == 0)
			return parent::delete();
		else
			return parent::save();
	}

}