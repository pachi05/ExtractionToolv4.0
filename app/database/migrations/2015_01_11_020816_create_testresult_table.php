<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestresultTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('testresults', function($table)
		{
			$table->bigIncrements('id');
			$table->string('meterNo')->nullable();
			$table->string('model')->nullable();
			$table->string('current')->nullable();
			$table->string('constant')->nullable();
			$table->string('temperature')->nullable();
			$table->string('humidity')->nullable();
			$table->date('testDate')->nullable();
			$table->string('conclusion24h')->nullable();
			$table->string('conclusion')->nullable();
			$table->timestamps('added_on');
			$table->string('tag');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('testresults');
	}

}
