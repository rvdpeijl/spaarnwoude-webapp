@extends('admin.template')

@section('content')
<div>
	<h1>Bewerk Agenda Item</h1>
	<button onClick="window.history.back(-1)">Terug</button>
	<br><br>

	{{ Form::model($agenda, array('method' => 'put', 'action' => array('AgendaController@update', $agenda->id)) ) }}

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

	    <label>Beschrijving:</label>
	    {{ Form::textarea('description') }}

	    <label>Start:</label>
	    <small>Formaat: JJJJ-MM-DD UU:MM:SS</small>
	    {{ Form::input('datetime', 'start') }}

	    <label>Eind:</label>
	    {{ Form::input('datetime', 'end') }}

	    <h3>Locatie</h3>
	    <hr>

	    <label>Adres:</label>
	    {{ Form::text('address') }}

	    <label>Postcode:</label>
	    {{ Form::text('zipcode') }}

	    <label>Stad:</label>
	    {{ Form::text('city') }}


	    <button class="saveagenda">Opslaan</button>

	{{ Form::close() }}
</div>
@stop