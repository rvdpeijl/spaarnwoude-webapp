<?php

class AgendaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$agendaList = [];
		foreach (Agenda::all() as $agenda) {
			$categories = [];
			$agenda->categories = [];
			$agendaCategories = AgendaCategory::where('agenda_id', '=', $agenda->id)->get();
			foreach ($agendaCategories as $item) {
				$category = Category::find($item->category_id);
				array_push($categories, $category->name);
			}
			$agenda->categories = $categories;
			array_push($agendaList, $agenda);
		}
		return Response::json($agendaList, 200);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.agenda.create');
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

		if ($beleven !== 'on' && $doen !== 'on' && $genieten !== 'on' && $verblijven !== 'on') {
			return Redirect::to('api/agenda/create')->with(array('input' => Input::all(), 'error' => 'Selecteer een categorie'));
		}

		$agenda = Agenda::create(Input::all());
		$agenda->description = Input::get('description');
		$agenda->save();

		if ($beleven === 'on') {
			AgendaCategory::create(array(
				'agenda_id' => $agenda->id,
				'category_id' => 1
			));
		}

		if ($doen === 'on') {
			AgendaCategory::create(array(
				'agenda_id' => $agenda->id,
				'category_id' => 2
			));
		}

		if ($genieten === 'on') {
			AgendaCategory::create(array(
				'agenda_id' => $agenda->id,
				'category_id' => 3
			));
		}

		if ($verblijven === 'on') {
			AgendaCategory::create(array(
				'agenda_id' => $agenda->id,
				'category_id' => 4
			));
		}

		return Redirect::to('admin/agenda')->with(array('message' => 'Agenda Item gecreeërd'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$agenda = Agenda::findOrFail($id); 
		$categories = [];

		/**
		
			TODO:
			- ModelNotFoundException Errorhandling
		
		**/
		
		$agenda->categories = [];
		$agendaCategories = AgendaCategory::where('agenda_id', '=', $agenda->id)->get();
		
		foreach ($agendaCategories as $item) {
			$category = Category::find($item->category_id);
			array_push($categories, $category->name);
		}

		$agenda->categories = $categories;

		return Response::json($agenda, 200);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$agenda = Agenda::find($id);

		$catids = array();
		$agendacategories = AgendaCategory::where('agenda_id', '=', $agenda->id)->get();
		foreach ($agendacategories as $key => $value) {
			array_push($catids, $value['category_id']);
		}

		return View::make('admin.agenda.edit')->with(array('agenda' => $agenda, 'catids' => $catids));
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
		$agenda = Agenda::find($id);

		$doen = Input::get('doen');
		$beleven = Input::get('beleven');
		$genieten = Input::get('genieten');
		$verblijven = Input::get('verblijven');

		if ($beleven !== 'on' && $doen !== 'on' && $genieten !== 'on' && $verblijven !== 'on') {
			return Redirect::action('AgendaController@edit', array($id))->with(array('input' => Input::all(), 'error' => 'Selecteer een categorie'));
		}

		$massDelete = AgendaCategory::where('agenda_id', '=', $agenda->id)->delete();

		if ($beleven === 'on') {
			AgendaCategory::create(array(
				'agenda_id' => $agenda->id,
				'category_id' => 1
			));
		}

		if ($doen === 'on') {
			AgendaCategory::create(array(
				'agenda_id' => $agenda->id,
				'category_id' => 2
			));
		}

		if ($genieten === 'on') {
			AgendaCategory::create(array(
				'agenda_id' => $agenda->id,
				'category_id' => 3
			));
		}

		if ($verblijven === 'on') {
			AgendaCategory::create(array(
				'agenda_id' => $agenda->id,
				'category_id' => 4
			));
		}

		$agenda->name 			= $updated['name'];
		$agenda->description	= $updated['description'];
		$agenda->start 			= $updated['start'];
		$agenda->end 			= $updated['end'];

		$agenda->save();

		return Redirect::to('admin/agenda')->with(array('message' => 'Agenda item opgeslagen'));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$agenda = Agenda::find($id);
        $agenda->delete();

        $massDelete = AgendaCategory::where('agenda_id', '=', $id)->delete();

        return Redirect::to('/admin/agenda/')
        	->with('message', 'Agenda item verwijderd.');
	}


}
