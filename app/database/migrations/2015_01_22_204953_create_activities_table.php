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
			$table->string('name');
			$table->string('organization');
			$table->float('latitude', 10);
			$table->float('longitude', 10);
			$table->text('short_desc', 255);
			$table->longText('long_desc', 2500);
			$table->string('street_name');
			$table->string('zipcode', 6);
			$table->string('city');
			$table->string('phone', 20);
			$table->string('website_url');
			$table->string('facebook_url');
			$table->string('twitter_url');
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
		Schema::drop('activities');
	}

}
