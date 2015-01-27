@extends('admin.template')

@section('content')

	<h1>Nieuwe Activiteit</h1>
	<button onClick="window.history.back(-1)">Terug</button>
	<hr>
	{{ Form::open() }}

@stop