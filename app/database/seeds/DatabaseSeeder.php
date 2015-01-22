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
			'name' => 'Vakantiehuis huren bij Droomparken', 
			'organization' => 'Droomparken'
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
	}

}