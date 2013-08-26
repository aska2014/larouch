<?php

class AdminAuth extends Auth{

	public static function guest()
	{
		if(!parent::guest() && parent::user()->type == "admin")
			return false;
		parent::logout();
		return true;
	}

	public static function attempt($arguments = array())
	{
		if(!parent::attempt($arguments))
		{
			return false; 
		}
		if(parent::user()->type != 'admin')
		{
			parent::logout();
			return false;
		}
		return true;
	}

	/**
	 * Checks to see if this admin is an editor which mean he is of type 3
	 * @return boolean
	 */
	public static function editor()
	{
		if(!self::guest() && self::user()->admin_type == '3')
			return true;
		return false;
	}

	/**
	 * Checks to see if this admin can manage orders which mean he is of type 1 or 2
	 * @return boolean
	 */
	public static function checker()
	{
		if(!self::guest() && in_array(self::user()->admin_type, array('1','2')))
			return true;
		return false;
	}
}