<?php

class Create_Subcategories_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subcategories',function($table)
		{
			$table->increments('id');
			$table->integer('category_id');
			$table->string('title_en');
			$table->string('title_ar');
			$table->integer('_order');
			$table->timestamps();

			$table->foreign('category_id')->references('id')->on('categories')->on_delete('CASCADE');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subcategories');
	}

}