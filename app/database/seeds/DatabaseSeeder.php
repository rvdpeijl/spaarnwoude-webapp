<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('ActivityTableSeeder');
		$this->call('CategoryTableSeeder');
		$this->call('ActivityCategoryTableSeeder');
	}
}

class ActivityTableSeeder extends Seeder {

	public function run()
	{
		DB::table('activities')->delete();

		Activity::create(array(
			'name' => 'Huur een Droomparken bungalow!', 
			'organization' => 'Droomparken',
			'latitude' => 52.413307,
			'longitude' => 4.680558,
			'short_desc' => 'Korte beschrijving',
			'long_desc' => 'Lange beschrijving',
			'street_name' => 'Jansstraat 5',
			'zipcode' => '2012XX',
			'city' => 'Haarlem',
			'phone' => '023-5252525',
			'website_url' => 'http://www.example.com/',
			'facebook_url' => 'http://www.facebook.com/spaarnwoude',
			'twitter_url' => 'http://www.twitter.com/spaarnwoude'
		));
	}

}

class CategoryTableSeeder extends Seeder {

	public function run()
	{
		DB::table('categories')->delete();

		Category::create(array(
			'name' => 'Beleven',
			'slug' => 'beleven'
		));

		Category::create(array(
			'name' => 'Doen',
			'slug' => 'doen'
		));

		Category::create(array(
			'name' => 'Genieten',
			'slug' => 'genieten'
		));

		Category::create(array(
			'name' => 'Verblijven',
			'slug' => 'verblijven'
		));
	}

}

class ActivityCategoryTableSeeder extends Seeder {

	public function run()
	{
		DB::table('activity_categories')->delete();

		ActivityCategory::create(array(
			'activity_id' => 1,
			'category_id' => 1
		));

		ActivityCategory::create(array(
			'activity_id' => 1,
			'category_id' => 2
		));
	}

}