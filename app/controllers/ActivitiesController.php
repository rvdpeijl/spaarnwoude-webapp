<?php

class ActivitiesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$activities = [];
		foreach (Activity::all() as $activity) {
			$categories = [];
			$activity->categories = [];
			$activityCategories = ActivityCategory::where('activity_id', '=', $activity->id)->get();
			foreach ($activityCategories as $item) {
				$category = Category::find($item->category_id);
				array_push($categories, $category->name);
			}
			$activity->categories = $categories;
			array_push($activities, $activity);
		}
		return Response::json($activities, 200);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.activities.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$doen = Input::get('doen');
		$beleven = Input::get('beleven');
		$genieten = Input::get('genieten');
		$verblijven = Input::get('verblijven');

		$files = Input::file('files');
		$logo = Input::file('logo');

	    if ($beleven !== 'on' && $doen !== 'on' && $genieten !== 'on' && $verblijven !== 'on') {
			return Redirect::to('api/activities/create')->with(array('input' => Input::all(), 'error' => 'Selecteer een categorie'));
		}

		if ($files[0] === null) {
			return Redirect::to('api/activities/create')->with(array('input' => Input::all(), 'error' => 'Selecteer op zijn minst één afbeelding'));
		}

		$activity = Activity::create(Input::all());

	    if ($beleven === 'on') {
			ActivityCategory::create(array(
				'activity_id' => $activity->id,
				'category_id' => 1
			));
		}

		if ($doen === 'on') {
			ActivityCategory::create(array(
				'activity_id' => $activity->id,
				'category_id' => 2
			));
		}

		if ($genieten === 'on') {
			ActivityCategory::create(array(
				'activity_id' => $activity->id,
				'category_id' => 3
			));
		}

		if ($verblijven === 'on') {
			ActivityCategory::create(array(
				'activity_id' => $activity->id,
				'category_id' => 4
			));
		}

	    if ($logo) {
	    	$destinationPath = public_path().'/img/activities/'.$activity->id.'/logo/';
	    	$filename = $logo->getClientOriginalName();
	    	$upload_success = $logo->move($destinationPath, $filename);
	    	$activity->logo = $filename;
	    	$activity->save();
	    }

	    foreach($files as $key => $file) {
	    	if ($key < 5) {
	    		$destinationPath = public_path().'/img/activities/'.$activity->id.'/medium/';
                $filename = $file->getClientOriginalName();
		        $upload_success = $file->move($destinationPath, $filename);
		        $column = 'img'.($key+1);
		        $activity->$column = $filename;
		        $activity->save();
	    	}
	    }

		if( $upload_success ) {			 
		    return Redirect::to('admin/activities')->with(array('message' => 'Activiteit gecreeërd'));
		} else {
			return Redirect::to('api/activities/create')->with(array('input' => Input::all(), 'error' => 'Er is iets mis gegaan met het opslaan van de afbeelding.'));
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$activity = Activity::findOrFail($id); 
		$categories = [];

		/**
		
			TODO:
			- ModelNotFoundException Errorhandling
		
		**/
		
		$activity->categories = [];
		$activityCategories = ActivityCategory::where('activity_id', '=', $activity->id)->get();
		
		foreach ($activityCategories as $item) {
			$category = Category::find($item->category_id);
			array_push($categories, $category->name);
		}

		$activity->categories = $categories;

		return Response::json($activity, 200);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$activity = Activity::find($id);

		$catids = array();
		$activitycategories = ActivityCategory::where('activity_id', '=', $activity->id)->get();
		foreach ($activitycategories as $key => $value) {
			array_push($catids, $value['category_id']);
		}


		return View::make('admin.activities.edit')->with(array('activity' => $activity, 'catids' => $catids));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$updated = Input::all();
		$activity = Activity::find($id);
		$images = [];

		$currentImages = Input::get('currentImages');
		$deletedImages = Input::get('deletedImages');
		$imagesToUpload = Input::file('files');
		$currentImages = json_decode($currentImages, true);
		$deletedImages = json_decode($deletedImages, true);
		$logo = Input::file('logo');

		foreach ($deletedImages as $key => $image) {
			$activity = $this->removeImage($activity, $image['name']);
		}

		$doen = Input::get('doen');
		$beleven = Input::get('beleven');
		$genieten = Input::get('genieten');
		$verblijven = Input::get('verblijven');

		if ($beleven !== 'on' && $doen !== 'on' && $genieten !== 'on' && $verblijven !== 'on') {
			return Redirect::action('ActivitiesController@edit', array($id))->with(array('input' => Input::all(), 'error' => 'Selecteer een categorie'));
		}

		$massDelete = ActivityCategory::where('activity_id', '=', $activity->id)->delete();

		if ($beleven === 'on') {
			ActivityCategory::create(array(
				'activity_id' => $activity->id,
				'category_id' => 1
			));
		}

		if ($doen === 'on') {
			ActivityCategory::create(array(
				'activity_id' => $activity->id,
				'category_id' => 2
			));
		}

		if ($genieten === 'on') {
			ActivityCategory::create(array(
				'activity_id' => $activity->id,
				'category_id' => 3
			));
		}

		if ($verblijven === 'on') {
			ActivityCategory::create(array(
				'activity_id' => $activity->id,
				'category_id' => 4
			));
		}

		if ($logo) {
	    	$destinationPath = public_path().'/img/activities/'.$activity->id.'/logo/';
	    	$filename = $logo->getClientOriginalName();
	    	$upload_success = $logo->move($destinationPath, $filename);
	    	$activity->logo = $filename;
	    	$activity->save();
	    }

	    if ($currentImages[0] !== null) {

	    	foreach ($currentImages as $key => $value) {
				if ($value['img'] !== null) {
					$column = 'img'.($key+1);
					$activity->$column = $value['img'];
					array_push($images, $value['img']);
				}
			}
	    }

		if ($imagesToUpload[0] !== null) {
			foreach($imagesToUpload as $key => $file) {
		    	if (count($images) < 5) {
		    		$destinationPath = public_path().'/img/activities/'.$activity->id.'/medium/';
	                $filename = $file->getClientOriginalName();
			        $upload_success = $file->move($destinationPath, $filename);
			        array_push($images, $filename);
		    	}
		    }
		}

		if (count($images) > 0) {
			foreach ($images as $key => $value) {
				$column = 'img'.($key+1);
		        $activity->$column = $value;
		        $activity->save();
			}
		} else {
			return Redirect::action('ActivitiesController@edit', array($id))->with(array('input' => Input::all(), 'error' => 'Selecteer minimaal één afbeelding'));
		}

		$activity->name 			= $updated['name'];
		$activity->organization 	= $updated['organization'];
		$activity->latitude			= $updated['latitude'];
		$activity->longitude		= $updated['longitude'];
		$activity->short_desc		= $updated['short_desc'];
		$activity->long_desc		= $updated['long_desc'];
		$activity->address 			= $updated['address'];
		$activity->zipcode 			= $updated['zipcode'];
		$activity->city 			= $updated['city'];
		$activity->phone			= $updated['phone'];
		$activity->website_url		= $updated['website_url'];
		$activity->facebook_url		= $updated['facebook_url'];
		$activity->twitter_url		= $updated['twitter_url'];

		$activity->save();
		return Redirect::to('admin/activities')->with(array('message' => 'Activiteit opgeslagen'));
		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$activity = Activity::find($id);
        $activity->delete();
        $dir = public_path().'/img/activities/'.$activity->id;
        $success = File::deleteDirectory($dir);

        $massDelete = ActivityCategory::where('activity_id', '=', $id)->delete();

        return Redirect::to('/admin/activities/')
        	->with('message', 'Activiteit verwijderd.');
	}

	private function removeImage($activity, $image)
	{
		$delete = File::delete(public_path().'/img/activities/'.$activity->id.'/medium/'.$activity->$image);
		$activity->$image = null;
		$activity = $this->reassign($activity);
		return $activity;
	}

	private function reassign($activity)
	{
		$input = array(
			$activity->img1,
			$activity->img2,
			$activity->img3,
			$activity->img4,
			$activity->img5
		);

		$activity->img1 = null;
		$activity->img2 = null;
		$activity->img3 = null;
		$activity->img4 = null;
		$activity->img5 = null;

		$output = array_filter($input);
		$output = array_values($output);

		foreach ($output as $key => $value) {
			$column = 'img'.($key+1);
			$activity->$column = $value;
		}

		return $activity;
	}

	public function massAdd()
	{
		
		// $activities = Input::get('activities');
		// foreach ($activities as $key => $activity) {
		// 	Activity::create(array(
		// 		'name' => $activity->name,
		// 		'organization' => $activity->organisatie,
		// 		'latitude' => $activity->latitude,
		// 		'longitude' => $activity->longitude,
		// 		'short_desc' => $activity->short_desc,
		// 		'long_desc' => $activity->long_desc,
		// 		'address' => $activity->straatnaam,
		// 		'zipcode' => $activity->postcode,
		// 		'city' => $activity->plaats,
		// 		'phone' => $activity->telefoon,
		// 		'website_url' => $activity->website_url,
		// 		'facebook_url' => $activity->facebook_url,
		// 		'twitter_url' => $activity->twitter_url
		// 	));
		// }

		// return response::json(Activity::all(), 200);
	}
}
