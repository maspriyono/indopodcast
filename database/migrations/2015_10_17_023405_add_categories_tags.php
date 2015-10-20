<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoriesTags extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('description')->nullable();
			$table->timestamps();
		});

		Schema::create('tags', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('description')->nullable();
			$table->timestamps();
		});

/*
		Schema::table('items', function($table)
		{
		    $table->integer('category_id')->unsigned();
			$table->foreign('category_id')
				->references('id')
				->on('categories')
				->nullable();
		});
		*/

		Schema::create('items_tags', function(Blueprint $table) {
			$table->integer('tag_id')->unsigned();
			$table->foreign('tag_id')
				->references('id')
				->on('tags');
			$table->integer('item_id')->unsigned();
			$table->foreign('item_id')
				->references('id')
				->on('items');
			$table->unique( array('tag_id', 'item_id') );
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
		Schema::drop('tags');
		Schema::drop('items_tags');

		if (Schema::hasTable('items'))
		{
		    Schema::table('items', function($table)
			{
			    $table->dropColumn('category_id');
			});
		}
	}

}
