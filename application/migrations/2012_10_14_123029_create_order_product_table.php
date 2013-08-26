<?php

class Create_Order_Product_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_product', function($table)
		{
			$table->increments('id');
			$table->integer('order_id');
			$table->integer('product_id');
			$table->integer('qty');
			$table->float('price');
			$table->timestamps();

			$table->foreign('order_id')->references('id')->on('orders')->on_delete('CASCADE');
			$table->foreign('product_id')->references('id')->on('products')->on_delete('CASCADE');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}