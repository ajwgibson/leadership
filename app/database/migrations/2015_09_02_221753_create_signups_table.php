<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('signups', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('activity_id')->unsigned();
			$table->integer('booking_id')->unsigned();
			
			$table->timestamps();

			$table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
			$table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('signups');
	}

}
