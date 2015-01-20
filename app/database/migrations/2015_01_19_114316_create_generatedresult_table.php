<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneratedresultTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('generatedresults', function($table)
		{
			$table->increments('id');
			$table->string('filename');
			$table->string('created_by');
			$table->timestamps();
			$table->integer('download');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('generatedresults');
	}

}
