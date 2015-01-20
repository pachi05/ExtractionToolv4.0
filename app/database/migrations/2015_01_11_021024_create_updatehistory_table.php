<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdatehistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('updatehistories', function($table)
		{
			$table->increments('id');
			$table->date('lastTestDate');
			$table->string('tag');
			$table->string('updated_by');
			$table->timestamps('updated_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('updatehistories');
	}

}
