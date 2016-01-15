<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirmsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('firms', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('full_organisation_name', 150);
			$table->string('organisation_name', 80);
			$table->string('okpo', 10);
			$table->string('ogrn', 13);
			$table->string('inn', 13);
			$table->string('kpp', 9);
			$table->string('rs', 20);
			$table->string('bik', 9);
			$table->string('bank', 200);
			$table->string('ks', 20);
			$table->string('face_position', 50);
			$table->string('face_fio', 50);
			$table->string('base_document', 100);
			$table->string('place_address', 255);
			$table->string('post_address', 255);
			$table->string('contact_face_fio', 50);
			$table->string('phone', 20);
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
		Schema::drop('firms');
	}

}
