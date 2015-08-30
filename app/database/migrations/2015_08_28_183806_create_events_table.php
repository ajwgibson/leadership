<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leadership_events', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name', '100');
			$table->text('description')->nullable();
			$table->date('start_date');
			$table->date('end_date')->nullable();
			$table->text('notes')->nullable();

			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('leadership_events');
	}

}
