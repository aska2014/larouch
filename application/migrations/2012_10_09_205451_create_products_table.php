<?php

class Create_Products_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function($table)
		{
			$table->increments('id');
			$table->integer('subcategory_id');
			$table->string('title_en');
			$table->string('title_ar');
			// $table->text('desc_en');
			// $table->text('desc_ar');
			$table->float('price');
			$table->string('type');
			$table->timestamps();

			$table->foreign('subcategory_id')->references('id')->on('subcategories')->on_delete('CASCADE');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}