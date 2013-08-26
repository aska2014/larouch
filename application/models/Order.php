<?php

class Order extends Eloquent{

	/*
	| Defining Relationships
	|------------------------------------------------------------------
	*/
		public function products(){ return $this->has_many_and_belongs_to('Product'); }
		public function member(){ return $this->belongs_to('Member'); }
	/*
	|-----------------------------------------------------------------
	*/


	/*
	| Find and order by overwriting static functions
	|------------------------------------------------
	| Getting orders depending on the admin type
	| Each order has 3 stages
	*/
	public static function order_by($arg1, $arg2)
	{
		if(AdminAuth::checker())
			return Order::where_stage(Auth::user()->admin_type)->order_by($arg1, $arg2);
	}


	public function date()
	{
		return date('d M, h:m a', strtotime($this->created_at));
	}

	/**
     * Override parent save method
     * Save If checker and of type equals the same stage as order
     * OR If user and stage == 1
	 */
	public function save()
	{
		if(!Auth::guest())
			return parent::save();
		return false;
	}

	/**
	 * Override parent delete method
	 */
	public function delete()
	{
		if(AdminAuth::checker())
			return parent::delete();
		return false;
	}

	public function accept()
	{
		if(AdminAuth::checker() && AdminAuth::user()->admin_type == $this->stage)
		{
			$this->stage = 2;
			return parent::save();
		}
		return false;
	}

	public function finish()
	{
		if(AdminAuth::checker() && AdminAuth::user()->admin_type == $this->stage)
		{
			$this->stage = 3;
			return parent::save();
		}
		return false;
	}
	
}