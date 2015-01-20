<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempresultTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tempresults', function($table)
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
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tempresults');
	}

}
