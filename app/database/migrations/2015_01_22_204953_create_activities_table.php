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
			$table->double('latitude', 9, 6);
			$table->double('longitude', 9, 6);
			$table->text('short_desc', 255);
			$table->longText('long_desc', 1500);
			$table->string('address');
			$table->string('zipcode', 6);
			$table->string('city');
			$table->string('phone', 20);
			$table->string('website_url')->nullable();
			$table->string('facebook_url')->nullable();
			$table->string('twitter_url')->nullable();
			$table->string('logo')->nullable();
			$table->string('img1');
			$table->string('img2')->nullable();
			$table->string('img3')->nullable();
			$table->string('img4')->nullable();
			$table->string('img5')->nullable();
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
