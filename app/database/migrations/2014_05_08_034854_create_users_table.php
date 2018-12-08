<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email',255)->unique();;
			$table->string('password',64);
			$table->string('name',255);
			$table->string('remember_token',255);
			$table->integer('group_id');
			$table->text('address');
			$table->string('phone',20);
			$table->string('gtalk',20);
			$table->string('skype',20);
			$table->string('whatsapp',20);
			$table->integer('online_status');
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
		Schema::drop('users');
	}

}
