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
			$activity->categories = [];
			$activityCategories = ActivityCategory::where('activity_id', '=', $activity->id)->get();
			
			foreach ($activityCategories as $item) {
				$categories = [];
				$category = Category::find($item->category_id);
				array_push($categories, $category->name);
				$activity->categories = $categories;
			}
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
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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

		/**
		
			TODO:
			- ModelNotFoundException Errorhandling
		
		**/
		
		$activity->categories = [];
		$activityCategories = ActivityCategory::where('activity_id', '=', $activity->id)->get();
		
		foreach ($activityCategories as $item) {
			$categories = [];
			$category = Category::find($item->category_id);
			array_push($categories, $category->name);
			$activity->categories = $categories;
		}

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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
