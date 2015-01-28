@extends('admin.template')

@section('content')

	<h1>Nieuwe Activiteit</h1>
	<button onClick="window.history.back(-1)">Terug</button>
	<br><br>

	{{ Form::open(array('action' => 'ActivitiesController@store', 'files' => true) ) }}

		<h3>Categorie(en)</h3>
		<hr>

		<div class="stats" style="overflow: auto; ">
		  <ul>
		    <li>
		    	<p>Doen</p>
		    	<span>
		    		<label class="label-switch">
						<input type="checkbox" name="doen" />
						<div class="checkbox"></div>
					</label>
		    	</span>
		    </li>
		    <li>
		    	<p>Beleven</p>
		    	<span>
		    		<label class="label-switch">
						<input type="checkbox" name="beleven" />
						<div class="checkbox"></div>
					</label>
		    	</span>
		    </li>
		    <li>
		    	<p>Genieten</p>
		    	<span>
		    		<label class="label-switch">
						<input type="checkbox" name="genieten" />
						<div class="checkbox"></div>
					</label>
		    	</span>
		    </li><li>
		    	<p>Verblijven</p>
		    	<span>
		    		<label class="label-switch">
						<input type="checkbox" name="verblijven" />
						<div class="checkbox"></div>
					</label>
		    	</span>
		    </li>
		  </ul>
		</div>
		<hr>

		<h3>Omschrijving</h3>
		<hr>

		<label>Naam:</label>
	    {{ Form::text('name') }}

	    <label>Organisatie:</label>
	    {{ Form::text('organization') }}

	    <label>Telefoonnummer:</label>
	    {{ Form::text('phone') }}

	    <label>Korte Beschrijving:</label>
	    {{ Form::textarea('short_desc') }}

	    <label>Lange Beschrijving:</label>
	    {{ Form::textarea('long_desc') }}

	    <label>Logo (Optioneel):</label>
	    {{ Form::file('logo') }}

	    <label>Afbeeldingen (maximaal 5):</label>
	    {{ Form::file('files[]', array('multiple' => true, 'class' => 'activityfiles')) }}

	    <h3>Locatie</h3>
	    <hr>

	    <label>Adres:</label>
	    {{ Form::text('address') }}

	    <label>Postcode:</label>
	    {{ Form::text('zipcode') }}

	    <label>Stad:</label>
	    {{ Form::text('city') }}

	    <label>Latitude:</label>
	    {{ Form::text('latitude') }}

	    <label>Longitude:</label>
	    {{ Form::text('longitude') }}

	    <h3>Online</h3>
	    <hr>

	    <label>Website URL:</label>
	    {{ Form::text('website_url') }}

	    <label>Facebook URL:</label>
	    {{ Form::text('facebook_url') }}

	    <label>Twitter URL:</label>
	    {{ Form::text('twitter_url') }}

	    <button class="saveactivity">Opslaan</button>

	{{ Form::close() }}

@stop