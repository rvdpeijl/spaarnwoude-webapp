@extends('admin.template')

@section('content')
<div ng-controller="activities">
	<h1>Bewerk Activiteit</h1>
	<button onClick="window.history.back(-1)">Terug</button>
	<br><br>

	{{ Form::model($activity, array('method' => 'put', 'files' => true, 'action' => array('ActivitiesController@update', $activity->id)) ) }}

	<button class="saveactivity">Opslaan</button>
	
	<input type="hidden" id="activityId" value="{{$activity->id}}">
	<input type="hidden" value="[[images]]" name="currentImages">
	<input type="hidden" value="[[deleted]]" name="deletedImages">

		<h3>Categorien</h3>
		<hr>

		<div class="stats" style="overflow: auto; ">
		  <ul>
		  	@foreach (Category::all() as $category)
			    <li>
			    	<p>{{$category->name}}</p>
			    	<span>
			    		<label class="label-switch">
			    			@if (in_array($category->id, $catids))
								<input type="checkbox" name="{{$category->slug}}" checked />
							@else
								<input type="checkbox" name="{{$category->slug}}"  />
							@endif
							<div class="checkbox"></div>
						</label>
			    	</span>
			    </li>
		    @endforeach
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
	    <div class="imgContainer">
	    	<div class="image" ng-if="activity.logo !== null">
	    		<img ng-src="/img/activities/[[activity.id]]/logo/[[activity.logo]]" alt="">
	    	</div>
	    </div>
	    {{ Form::file('logo') }}

	    <label>Afbeeldingen (maximaal 5):</label>
	    <div class="imgContainer">
	    	<div class="image" ng-repeat="image in images" ng-if="image.img !== null">
	    		<button class="delete" ng-click="remove($index, image)">X</button>
	    		<img ng-src="/img/activities/[[activity.id]]/medium/[[image.img]]" alt="">
	    	</div>
	    </div>
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
</div>
@stop