<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('documents', function(Blueprint $table)
		{
			$table->integer('service_order_id')->unsigned()->nullable();
			$table->foreign('service_order_id')->references('id')->on('service_orders')->onDelete('cascade')->onUpdate('cascade');
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
