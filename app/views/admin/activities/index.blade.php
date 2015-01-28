@extends('admin.template')

@section('content')

	<form action="/api/activities/create" method="get">
	    <button>Nieuwe Activiteit</button>
	</form>
	
	<table class="tables">
	  <thead>
	    <tr>
	      <th>Naam</th>
	      <th>Organisatie</th>
	      <th>Locatie</th>
	      <th>Categorie</th>
	      <th></th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach (Activity::all() as $activity)
	    	<tr>
	    		<td>{{ $activity->name }}</td>
	    		<td>{{ $activity->organization }}</td>
	    		<td>
	    			<a href="http://maps.google.com/maps?q={{$activity->latitude}},{{$activity->longitude}}&ll={{$activity->latitude}},{{$activity->longitude}}&z=13" target="_blank">Bekijk op Google maps</a>
	    		</td>
	    		<td>
	    			<ul>
		    			@foreach (ActivityCategory::where('activity_id', '=', $activity->id)->get() as $activitycategory)
							<li>- {{ Category::find($activitycategory->category_id)->name }}</li>
						@endforeach
					</ul>
	    		</td>
	    		<td>
	    			<form action="/api/activities/{{$activity->id}}/edit" method="get">
					    <button>Bewerk</button>
					</form>

					{{ Form::open(array('action' => array('ActivitiesController@destroy', $activity->id), 'method' => 'delete')) }}
				        <button onClick="return confirm('Wilt u deze activiteit verwijderen?')">Verwijder</button>
				    {{ Form::close() }}
	    		</td>
	    	</tr>
	    @endforeach
	</table>

@stop