<?php

class Member extends Eloquent{

	/*
	| Defining Relationships
	|------------------------------------------------------------------
	*/
		public function order(){ return $this->has_many('Order'); }
	/*
	|-----------------------------------------------------------------
	*/

	/**
	 * @return string $fullname
	 */
	public function name()
	{
		if($this->first_name != '')
			return ucfirst($this->first_name).' '.ucfirst($this->last_name);
		else if($this->type == 'admin')
			return 'Admin: '.ucfirst($this->email);
	}

	/**
     * Override parent save and delete methods
	 */
	public function delete()
	{
		if(AdminAuth::editor())
			return parent::delete();
		return false;
	}

}