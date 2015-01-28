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
		$this->call('UserTableSeeder');
	}
}

class ActivityTableSeeder extends Seeder {

	public function run()
	{
		DB::table('activities')->delete();

		Activity::create(array(
			'name' => 'Droomparken', 
			'organization' => 'Lorem',
			'latitude' => 52.438085,
			'longitude' => 4.673864,
			'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
			'long_desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis quaerat, voluptatibus ipsa numquam commodi, vero, fugit quibusdam quo excepturi odit error ea enim praesentium necessitatibus nemo, aliquid veniam iure ullam.',
			'address' => 'Jansstraat 5',
			'zipcode' => '2012XX',
			'city' => 'Haarlem',
			'phone' => '023-5252525',
			'website_url' => 'http://www.example.com/',
			'facebook_url' => 'http://www.facebook.com/spaarnwoude',
			'twitter_url' => 'http://www.twitter.com/spaarnwoude',
			'logo' => 'logo.png',
			'img1' => 'medium_image1.jpg',
			'img2' => 'medium_image1.jpg',
			'img3' => 'medium_image1.jpg',
			'img4' => 'medium_image1.jpg',
			'img5' => 'medium_image1.jpg'
		));

		Activity::create(array(
			'name' => 'De Toerist', 
			'organization' => 'Lorem',
			'latitude' => 52.413307,
			'longitude' => 4.680558,
			'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
			'long_desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis quaerat, voluptatibus ipsa numquam commodi, vero, fugit quibusdam quo excepturi odit error ea enim praesentium necessitatibus nemo, aliquid veniam iure ullam.',
			'address' => 'Jansstraat 5',
			'zipcode' => '2012XX',
			'city' => 'Haarlem',
			'phone' => '023-5252525',
			'website_url' => 'http://www.example.com/',
			'facebook_url' => 'http://www.facebook.com/spaarnwoude',
			'twitter_url' => 'http://www.twitter.com/spaarnwoude',
			'logo' => 'logo.png',
			'img1' => 'medium_image1.jpg',
			'img2' => 'medium_image1.jpg',
			'img3' => 'medium_image1.jpg',
			'img4' => 'medium_image1.jpg',
			'img5' => 'medium_image1.jpg'
		));

		Activity::create(array(
			'name' => 'Actionplanet', 
			'organization' => 'Lorem',
			'latitude' => 52.442271,
			'longitude' => 4.689656,
			'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
			'long_desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis quaerat, voluptatibus ipsa numquam commodi, vero, fugit quibusdam quo excepturi odit error ea enim praesentium necessitatibus nemo, aliquid veniam iure ullam.',
			'address' => 'Jansstraat 5',
			'zipcode' => '2012XX',
			'city' => 'Haarlem',
			'phone' => '023-5252525',
			'website_url' => 'http://www.example.com/',
			'facebook_url' => 'http://www.facebook.com/spaarnwoude',
			'twitter_url' => 'http://www.twitter.com/spaarnwoude',
			'logo' => 'logo.png',
			'img1' => 'medium_image1.jpg',
			'img2' => 'medium_image1.jpg',
			'img3' => 'medium_image1.jpg',
			'img4' => 'medium_image1.jpg',
			'img5' => 'medium_image1.jpg'
		));

		Activity::create(array(
			'name' => 'Boerengolf', 
			'organization' => 'Lorem',
			'latitude' => 52.420710,
			'longitude' => 4.685537,
			'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
			'long_desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis quaerat, voluptatibus ipsa numquam commodi, vero, fugit quibusdam quo excepturi odit error ea enim praesentium necessitatibus nemo, aliquid veniam iure ullam.',
			'address' => 'Jansstraat 5',
			'zipcode' => '2012XX',
			'city' => 'Haarlem',
			'phone' => '023-5252525',
			'website_url' => 'http://www.example.com/',
			'facebook_url' => 'http://www.facebook.com/spaarnwoude',
			'twitter_url' => 'http://www.twitter.com/spaarnwoude',
			'logo' => 'logo.png',
			'img1' => 'medium_image1.jpg',
			'img2' => 'medium_image1.jpg',
			'img3' => 'medium_image1.jpg',
			'img4' => 'medium_image1.jpg',
			'img5' => 'medium_image1.jpg'
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

		ActivityCategory::create(array(
			'activity_id' => 2,
			'category_id' => 1
		));

		ActivityCategory::create(array(
			'activity_id' => 2,
			'category_id' => 3
		));

		ActivityCategory::create(array(
			'activity_id' => 3,
			'category_id' => 3
		));

		ActivityCategory::create(array(
			'activity_id' => 3,
			'category_id' => 4
		));

		ActivityCategory::create(array(
			'activity_id' => 4,
			'category_id' => 1
		));

		ActivityCategory::create(array(
			'activity_id' => 4,
			'category_id' => 2
		));
	}

}

class UserTableSeeder extends Seeder {
	public function run()
	{
		User::create(array(
			'firstname' => 'Admin',
			'lastname' => 'Admin',
			'username' => 'admin',
			'password' => Hash::make('password')
		));
	}
}