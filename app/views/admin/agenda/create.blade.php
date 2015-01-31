@extends('admin.template')

@section('content')

	<h1>Nieuw Agenda Item</h1>
	<button onClick="window.history.back(-1)">Terug</button>
	<br><br>

	{{ Form::open(array('action' => 'AgendaController@store', 'files' => true) ) }}

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

	    <label>Beschrijving:</label>
	    {{ Form::textarea('description') }}

	    <label>Start:</label>
	    <small>Formaat: JJJJ-MM-DD UU:MM:SS</small>
	    {{ Form::input('datetime', 'start') }}

	    <label>Eind:</label>
	    {{ Form::input('datetime', 'end') }}

	    <button class="saveagenda">Opslaan</button>

	{{ Form::close() }}

@stop