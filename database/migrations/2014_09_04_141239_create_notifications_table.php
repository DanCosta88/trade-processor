<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('notifications', function(Blueprint $table)
		{
			$table->increments('id');

			// id of coder that make action
			$table->integer('actor_id')->index();
			// id of coder that receive action
			$table->integer('subject_id')->index();
			// id of the object related to notification
			$table->integer('object_id')->index();
			// id for table notificationtypes
			$table->integer('type_id')->index();
			// boolean for notification status
			$table->integer('seen')->index()->default(0);

			$table->timestamps();

        });

		Schema::create('notificationtypes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 30);
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
		Schema::drop('notifications');
		Schema::drop('notificationtypes');
	}

}
