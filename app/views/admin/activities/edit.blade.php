@extends('admin.template')

@section('content')

	<h1>Bewerk Activiteit</h1>
	<button onClick="window.history.back(-1)">Terug</button>
	<br><br>

	{{ Form::model($activity, array('action' => 'ActivitiesController@store') ) }}

		<h3>Omschrijving</h3>
		<hr>

		<label>Naam:</label>
	    {{ Form::text('name') }}

	    <label>Organisatie:</label>
	    {{ Form::text('organization') }}

	    <label>Korte Beschrijving:</label>
	    {{ Form::textarea('short_desc') }}

	    <label>Lange Beschrijving:</label>
	    {{ Form::textarea('long_desc') }}

	    <h3>Locatie</h3>
	    <hr>

	    <label>Straatnaam:</label>
	    {{ Form::text('street_name') }}

	    <label>Postcode:</label>
	    {{ Form::text('zipcode') }}

	    <label>Stad:</label>
	    {{ Form::text('city') }}

	    <label>Latitude:</label>
	    {{ Form::text('latitude') }}

	    <label>Longitude:</label>
	    {{ Form::text('longitude') }}

	{{ Form::close() }}

@stop