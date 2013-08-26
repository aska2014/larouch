<?php

class Create_Orders_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function($table)
		{
			$table->increments('id');
			$table->integer('member_id');
			$table->string('address');
			$table->string('phone');
			$table->date('deliver_at');
			$table->string('deliver_range');
			$table->integer('stage');
			$table->timestamps();

			$table->foreign('member_id')->references('id')->on('members')->on_delete('CASCADE');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}