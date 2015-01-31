@extends('admin.template')

@section('content')
<div>
	<h1>Bewerk Nieuws Item</h1>
	<button onClick="window.history.back(-1)">Terug</button>
	<br><br>

	{{ Form::model($newsItem, array('method' => 'put', 'files' => true, 'action' => array('NewsController@update', $newsItem->id)) ) }}

	<label>Titel:</label>
    {{ Form::text('title') }}

    <label>Subtitel: (Optioneel)</label>
    {{ Form::textarea('subtitle') }}

    <label>Afbeelding:</label>
    <div class="currentImage"><img src="/img/news/{{$newsItem->id}}/featured_image/{{$newsItem->featured_image}}" alt=""></div>
    {{ Form::file('featured_image', array('class' => 'activityfiles')) }}

    <label>Content:</label>
    {{ Form::textarea('content', null, ['id' => 'newsContent']) }}
    <script>
        CKEDITOR.replace( 'newsContent' );
    </script>
    <p>&nbsp;</p>

    <button class="savenews">Opslaan</button>

	{{ Form::close() }}
</div>
@stop