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

		$input = Input::all();
		
		$activity = Activity::create(Input::all());

		// Checks if validator passes
		if ( $activity->validate($input)) {

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
					return Redirect::to('api/activities/create')->with(array('input' => Input::all(), 'errors' => $errors));
				}
				
				// Add logo
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
        	return Redirect::to('api/activities/create')->with(array('input' => Input::all(), 'error' => $validationErrors));
        }

        if (count($errors > 0)) {
        	return Redirect::to('api/activities/create')->with(array('input' => Input::all(), 'errors' => $errors));
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

		$errors = array();

		$currentImageCount = 1;
		$uploadImageCount = 0;
		$deletedImageCount = 0;

		$currentImages = Input::get('currentImages');
		$deletedImages = Input::get('deletedImages');

		$imagesToUpload = Input::file('files');
		
		$currentImages = json_decode($currentImages, true);
		$deletedImages = json_decode($deletedImages, true);
					
		foreach ($currentImages as $key => $value) {
			if ($value['img'] !== null) {
				$currentImageCount++;
			}
		}

		// dd($currentImages);
		$logo = Input::file('logo');

		if (!empty($deletedImages)){
			$deletedImageCount++;
			$currentImageCount--;	
		}
		
		foreach ($imagesToUpload as $img) {
			if($img != null){
				$currentImageCount++;
				$uploadImageCount++;
			}			
		}

		$doen = Input::get('doen');
		$beleven = Input::get('beleven');
		$genieten = Input::get('genieten');
		$verblijven = Input::get('verblijven');

		if ($beleven !== 'on' && $doen !== 'on' && $genieten !== 'on' && $verblijven !== 'on') {
			return Redirect::action('ActivitiesController@edit', array($id))->with(array('input' => Input::all(), 'errors' => 'Selecteer een categorie'));
		}

		if ( $currentImageCount > 0 ) {

		$massDelete = ActivityCategory::where('activity_id', '=', $activity->id)->delete();

		// TODO: Normale update functie maken
				// mass delete word select from where id remove images(imagesToRemove)
		// uploaden werkt wel

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

	    if ($deletedImageCount > 0) {
	    	foreach($deletedImages as $key => $image) {
	    		// dd($deletedImages);
	    		$activity = $this->removeImage($activity, $image['name']);
	    	}
	    }
	    
// er zijn wel images om te uploaden
	    if ($uploadImageCount > 0) {
	    	foreach($imagesToUpload as $key => $file) {
		    	if ($key < 4) {
		    		$destinationPath = public_path().'/img/activities/'.$activity->id.'/medium/';
	                $filename = $file->getClientOriginalName();
			        $upload_success = $file->move($destinationPath, $filename);
			        $column = 'img'.($key+1);
			        $activity->$column = $filename;
			        $activity->save();
		    	}
	    	}
	    }

	    // dd($currentImages);
	    // 		if ($imagesToUpload[0] !== null) {
// 			foreach($imagesToUpload as $key => $file) {
// 		    	if (count($images) < 4) {
// 		    		$destinationPath = public_path().'/img/activities/'.$activity->id.'/medium/';
// 	                $filename = $file->getClientOriginalName();
// 			        $upload_success = $file->move($destinationPath, $filename);
// //$images[] = array($filename);
// 			       // array_push($images, $filename);
// 		    	}
// 		    }
// 		} 
//dd($images);
		// else {
        	//return Redirect::action('ActivitiesController@edit', array($id))->with(array('input' => Input::all(), 'errors' => $errors));
		// }

		// if (count($images) > 0) {
			foreach ($images as $key => $value) {
				$column = 'img'.($key+1);
		        $activity->$column = $value;
		        $activity->save();
			}
		// } else {
		
		// }

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
		// dd($currentImageCount, $deletedImageCount, $uploadImageCount);
		return Redirect::to('admin/activities')->with(array('message' => 'Activiteit opgeslagen'));

		} else {
			// dd($currentImageCount, $deletedImageCount, $uploadImageCount);
 			array_push($errors, "Selecteer minimaal 1 afbeelding");
			return Redirect::action('ActivitiesController@edit', array($id))->with(array('input' => Input::all(), 'errors' => $errors));
		}
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
