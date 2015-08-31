<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookings', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('first', 100);
			$table->string('last', 100);
			$table->string('church', 100)->nullable();
			$table->string('role', 100)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('contact_number', 100)->nullable();
			$table->dateTime('registration_date')->nullable();

			$table->integer('leadership_event_id')->unsigned();
			
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('leadership_event_id')->references('id')->on('leadership_events')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bookings');
	}

}
