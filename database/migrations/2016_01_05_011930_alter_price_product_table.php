<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPriceProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('price_product', function(Blueprint $table)
		{
			$table->foreign('price_id')->references('id')->on('prices')->onDelete('cascade')->onUpdate('cascade');
		});
		Schema::table('price_stantion', function(Blueprint $table)
		{
			$table->foreign('price_id')->references('id')->on('prices')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
