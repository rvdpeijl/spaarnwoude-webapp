@extends('admin.template')

@section('content')
	<form action="/api/news/create" method="get">
	    <button>Nieuw Item</button>
	</form>
	
	<table class="tables">
	  	<thead>
	    	<tr>
	      		<th>Titel</th>
	      		<th></th>
	    	</tr>
	  	</thead>
	  	<tbody>
	  	@foreach (News::all() as $item)
	  		<tr>
	  			<td>{{ $item->title }}</td>
	    		<td>
	    			<form action="/api/news/{{$item->id}}/edit" method="get">
					    <button>Bewerk</button>
					</form>

					{{ Form::open(array('action' => array('NewsController@destroy', $item->id), 'method' => 'delete')) }}
				        <button onClick="return confirm('Wilt u dit nieuws item verwijderen?')">Verwijder</button>
				    {{ Form::close() }}
	    		</td>
	  		</tr>
	  	@endforeach
	  	</tbody>
	</table>
@stop