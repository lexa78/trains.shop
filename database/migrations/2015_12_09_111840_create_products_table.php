<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('article', 15);
			$table->string('name', 35);
			$table->text('description');
			$table->integer('year_id')->unsigned();
			$table->foreign('year_id')->references('id')->on('years')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('factory_id')->unsigned();
			$table->foreign('factory_id')->references('id')->on('factories')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('condition_id')->unsigned();
			$table->foreign('condition_id')->references('id')->on('conditions')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('category_id')->unsigned()->nullable();
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
