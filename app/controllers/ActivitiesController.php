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
		$categories = array(
			'beleven' => array(
				'id' => 1,
				'checked' => Input::get('beleven')
			),
			'doen' => array(
				'id' => 2,
				'checked' => Input::get('doen')
			),
			'genieten' => array(
				'id' => 3,
				'checked' => Input::get('genieten')
			),
			'verblijven' => array(
				'id' => 4,
				'checked' => Input::get('verblijven')
			)
		);

		$files = Input::file('files');
		$logo = Input::file('logo');

		$errors = array();

		$activity = new Activity;

		$input = Input::all();

		// Checks if validator passes
		if ( $activity->validate(Input::all()) ) {

			// Checks if any of the categories are empty
			$emptyCategoryCount = 0;
			foreach ($categories as $category) {
				if ($category['checked'] !== 'on') {
					$emptyCategoryCount++;
				}
			}

			// Is it empty? Add new string to the errors array
			if ($emptyCategoryCount === count($categories)) {
				array_push($errors, 'Selecteer een categorie');
			}

			// Checks if there is at least one image
			if ($files[0] === null) {
				array_push($errors, 'Selecteer op zijn minst één afbeelding');
			}


			// Checks if there are any errors
			if (count($errors) > 0) {
				return Redirect::to('api/activities/create')->with(array('input' => $input, 'errors' => $errors));
			}

			$activity->fill($input);

			// Save Activity
			$activity->save();

			// Add logo
			if ($logo) {
		    	$destinationPath = public_path().'/img/activities/'.$activity->id.'/logo/';
		    	$filename = $logo->getClientOriginalName();
		    	$upload_success = $logo->move($destinationPath, $filename);
		    	$activity->logo = $filename;
		    }

		    // Add images
		    foreach($files as $key => $file) {
		    	if ($key < 5) {
		    		$destinationPath = public_path().'/img/activities/'.$activity->id.'/medium/';
	                $filename = $file->getClientOriginalName();
			        $upload_success = $file->move($destinationPath, $filename);
			        $column = 'img'.($key+1);
			        $activity->$column = $filename;
		    	}
		    }

		    // Save Activity
			$activity->save();

			// Save activity categories
			foreach ($categories as $category) {
				ActivityCategory::create(array(
					'activity_id' => $activity->id,
					'category_id' => $category['id']
				));
			}

            return Redirect::to('admin/activities')->with(array('message' => 'Activiteit gecreeërd'));
        } else {
        	// Gets error messages from laravel validator
        	$validationErrors = $activity->errors();
        	return Redirect::to('api/activities/create')->with(array('input' => $input, 'error' => $validationErrors));
        }

        if (count($errors > 0)) {
        	return Redirect::to('api/activities/create')->with(array('input' => $input, 'errors' => $errors));
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
		$categories = array(
			'beleven' => array(
				'id' => 1,
				'checked' => Input::get('beleven')
			),
			'doen' => array(
				'id' => 2,
				'checked' => Input::get('doen')
			),
			'genieten' => array(
				'id' => 3,
				'checked' => Input::get('genieten')
			),
			'verblijven' => array(
				'id' => 4,
				'checked' => Input::get('verblijven')
			)
		);

		$updated = Input::all();
		$activity = Activity::find($id);
		$images = [];

		$currentImages = Input::get('currentImages');
		$deletedImages = Input::get('deletedImages');
		$imagesToUpload = Input::file('files');
		$currentImages = json_decode($currentImages, true);
		$deletedImages = json_decode($deletedImages, true);
		$logo = Input::file('logo');

		// Create the Errors array
		$errors = array();

		// Checks if validator passes
		if ( $activity->validate($updated) ) {

			// Checks if any of the categories are empty
			$emptyCategoryCount = 0;
			foreach ($categories as $category) {
				if ($category['checked'] !== 'on') {
					$emptyCategoryCount++;
				}
			}

			// Is it empty? Add new string to the errors array
			if ($emptyCategoryCount === count($categories)) {
				array_push($errors, 'Selecteer een categorie');
			}

			// Delete all images first 
			foreach ($deletedImages as $key => $image) {
				if ($imagesToUpload[0] !== null) {
					$activity = $this->removeImage($activity, $image['name']);
				}
			}

			if ($imagesToUpload[0] !== null) {
				foreach($imagesToUpload as $key => $file) {
			    	if (count($images) < 4) {
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
	        	array_push($errors, 'Selecteer minimaal één afbeelding');
			}

			// if ($emptyImageCount === count($currentImages)) {
			// 	array_push($errors, 'Selecteer minimaal één afbeelding.');
			// }

			// Checks if there are any errors
			if (count($errors) > 0) {
				return Redirect::action('ActivitiesController@edit', array($id))->with(array('input' => $updated, 'errors' => $errors));
			}

		}

		// Delete all off the activity's categories prior to making new ones (i know, kinda hackish)
		$massDelete = ActivityCategory::where('activity_id', '=', $activity->id)->delete();

		// Save activity categories
		foreach ($categories as $category) {
			if ($category['checked'] === 'on') {
				ActivityCategory::create(array(
					'activity_id' => $activity->id,
					'category_id' => $category['id']
				));
			}
		}

		if ($logo) {
	    	$destinationPath = public_path().'/img/activities/'.$activity->id.'/logo/';
	    	$filename = $logo->getClientOriginalName();
	    	$upload_success = $logo->move($destinationPath, $filename);
	    	$activity->logo = $filename;
	    	$activity->save();
	    }

	    // return $currentImages;

	  //   if (count($currentImages) < 1) {

	  //   	foreach ($currentImages as $key => $value) {
			// 	if ($value['img'] !== null) {
			// 		$column = 'img'.($key+1);
			// 		$activity->$column = $value['img'];
			// 		array_push($images, $value['img']);
			// 	}
			// }
	  //   }

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
			$activity->img4
		);

		$activity->img1 = null;
		$activity->img2 = null;
		$activity->img3 = null;
		$activity->img4 = null;
		
		$output = array_filter($input);
		$output = array_values($output);

		foreach ($output as $key => $value) {
			$column = 'img'.($key+1);
			$activity->$column = $value;
		}

		return $activity;
	}
}
