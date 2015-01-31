@extends('admin.template')

@section('content')

	<h1>Nieuw Item</h1>
	<button onClick="window.history.back(-1)">Terug</button>
	<br><br>

	{{ Form::open(array('action' => 'NewsController@store', 'files' => true) ) }}

		<label>Titel:</label>
	    {{ Form::text('title') }}

	    <label>Subtitel: (Optioneel)</label>
	    {{ Form::textarea('subtitle') }}

	    <label>URL: (Optioneel)</label>
	    {{ Form::text('url') }}

	    <label>Afbeelding:</label>
	    {{ Form::file('featured_image', array('class' => 'activityfiles')) }}

	    <label>Content:</label>
	    {{ Form::textarea('content', null, ['id' => 'newsContent']) }}
        <script>
            CKEDITOR.replace( 'newsContent' );
        </script>
        <p>&nbsp;</p>

	    <button class="savenews">Opslaan</button>

	{{ Form::close() }}

@stop