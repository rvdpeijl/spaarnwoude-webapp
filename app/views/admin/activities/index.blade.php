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
	    			<form action="/api/activities/{{$activity->id}}/edit" method="get">
					    <button>Bewerk</button>
					</form>
					<form action="/api/activities/{{$activity->id}}/destroy" method="get">
					    <button onClick="return confirm('Wilt u deze activiteit verwijderen?')">Verwijder</button>
					</form>
	    		</td>
	    	</tr>
	    @endforeach
	</table>

@stop