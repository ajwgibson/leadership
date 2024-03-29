<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activities', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name', 100);
			$table->text('description')->nullable();

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
		Schema::drop('activities');
		
	}

}
