<?php

class NewsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(News::all(), 200);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.news.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$newsItem = News::create(Input::all());
		$featured_image = Input::file('featured_image');

		if ($featured_image) {
	    	$destinationPath = public_path().'/img/news/'.$newsItem->id.'/featured_image/';
	    	$filename = $featured_image->getClientOriginalName();
	    	$upload_success = $featured_image->move($destinationPath, $filename);
	    	$newsItem->featured_image = $filename;
	    	$newsItem->save();
	    }

	    return Redirect::to('admin/news')->with(array('message' => 'Nieuws item gecreeërd'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Response::json(News::find($id), 200);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('admin.news.edit')->with(array('newsItem' => News::find($id)));
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
		$newsItem = News::find($id);
		$featured_image = Input::file('featured_image');

		if ($featured_image) {
			$dir = public_path().'/img/news/'.$newsItem->id.'/featured_image';
        	$success = File::deleteDirectory($dir);

        	if ($success) {
        		$destinationPath = public_path().'/img/news/'.$newsItem->id.'/featured_image/';
		    	$filename = $featured_image->getClientOriginalName();
		    	$upload_success = $featured_image->move($destinationPath, $filename);
		    	$newsItem->featured_image = $filename;
        	}
	    }

	    $newsItem->title 		= $updated['title'];
	    $newsItem->subtitle		= $updated['subtitle'];
	    $newsItem->content 		= $updated['content'];
	   	$newsItem->save();

	   	return Redirect::to('/admin/news/')->with('message', 'Nieuws item bewerkt.');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$newsItem = News::find($id);
		$newsItem->delete();
		$dir = public_path().'/img/news/'.$id;
        $success = File::deleteDirectory($dir);

        if ($success) {
        	 return Redirect::to('/admin/news/')
        		->with('message', 'Nieuws item verwijderd');
        }
	}


}
