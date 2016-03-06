<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_orders', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('service_status_id', false, true)->unsigned();
			$table->integer('user_id', false, true)->unsigned();
			$table->integer('firm_id', false, true)->unsigned();
            $table->boolean('is_new')->define(1);
            $table->text('service_name');
            $table->float('service_price');
            $table->text('station_names')->nullable();
            $table->text('more_info')->nullable();
			$table->timestamps();
			$table->foreign('service_status_id')->references('id')->on('service_statuses')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('servece_orders');
	}

}
