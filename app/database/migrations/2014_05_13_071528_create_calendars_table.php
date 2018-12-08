<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('calendars', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title',255);
			$table->text('description');
			$table->date('start_date');
			$table->time('start_time');
			$table->date('end_date');
			$table->time('end_time');
			$table->integer('whole_day');
			$table->integer('public_visible');
			$table->string('location',255);
			$table->integer('user_id');
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
		Schema::drop('calendars');
	}

}
