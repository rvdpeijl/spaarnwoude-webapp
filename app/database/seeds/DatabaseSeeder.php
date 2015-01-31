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
		$this->call('AgendaTableSeeder');
		$this->call('AgendaCategoryTableSeeder');
		$this->call('NewsTableSeeder');
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

class AgendaTableSeeder extends Seeder {
	public function run()
	{
		Agenda::create(array(
			'name' => 'Agenda Item 1',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
			'start' => Carbon\Carbon::now(),
			'end' => Carbon\Carbon::tomorrow(),
			'address' => 'Straatnaam 39',
			'zipcode' => '2056AA',
			'city' => 'Waddinxveen'
		));

		Agenda::create(array(
			'name' => 'Item 2',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
			'start' => Carbon\Carbon::now(),
			'end' => Carbon\Carbon::tomorrow(),
			'address' => 'Straatnaam 39',
			'zipcode' => '2056AA',
			'city' => 'Waddinxveen'
		));
	}
}

class AgendaCategoryTableSeeder extends Seeder {
	public function run()
	{
		AgendaCategory::create(array(
			'agenda_id' => 1,
			'category_id' => 1
		));

		AgendaCategory::create(array(
			'agenda_id' => 1,
			'category_id' => 3
		));

		AgendaCategory::create(array(
			'agenda_id' => 2,
			'category_id' => 2
		));

		AgendaCategory::create(array(
			'agenda_id' => 2,
			'category_id' => 4
		));
	}
}

class NewsTableSeeder extends Seeder {
	public function run()
	{
		News::create(array(
			'title' => 'Lorem Ipsum',
			'subtitle' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, necessitatibus tenetur consectetur soluta delectus. Ipsum quidem dignissimos ab consequuntur facere iure accusamus, esse sint ducimus eveniet neque mollitia exercitationem est.',
			'content' => '<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo nobis placeat voluptate magni, molestias at illum expedita sunt minus quod quaerat accusantium deleniti voluptatibus odit rem consequatur aut, aspernatur esse!</div>
			<div>Itaque iste quod pariatur nostrum nihil doloremque optio eligendi, mollitia laboriosam aspernatur voluptatibus voluptatum sunt ipsa hic, magni, facilis veniam dolor ratione, sequi commodi ad iusto. Ipsam, odio! Et, nemo!</div>',
			'featured_image' => 'featured_image.jpg',
			'url' => 'http://www.example.com/'
		));
	}
}