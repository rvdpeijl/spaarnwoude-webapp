@extends('admin.template')

@section('content')
	<form action="/api/agenda/create" method="get">
	    <button>Nieuw Agenda Item</button>
	</form>
	
	<table class="tables">
	  	<thead>
	    	<tr>
	      		<th>Naam</th>
	      		<th>Omschrijving</th>
	      		<th>Starttijd</th>
	      		<th>Eindtijd</th>
	      		<th>Categorie</th>
	      		<th></th>
	    	</tr>
	  	</thead>
	  	<tbody>
	  	@foreach (Agenda::all() as $agenda)
	  		<tr>
	  			<td>{{ $agenda->name }}</td>
	  			<td><small>{{ $agenda->description }}</small></td>
	  			<td>{{ $agenda->start }}</td>
	  			<td>{{ $agenda->end }}</td>
	  			<td>
	    			<ul>
		    			@foreach (AgendaCategory::where('agenda_id', '=', $agenda->id)->get() as $agendacategory)
							<li>- {{ Category::find($agendacategory->category_id)->name }}</li>
						@endforeach
					</ul>
	    		</td>
	    		<td>
	    			<form action="/api/agenda/{{$agenda->id}}/edit" method="get">
					    <button>Bewerk</button>
					</form>

					{{ Form::open(array('action' => array('AgendaController@destroy', $agenda->id), 'method' => 'delete')) }}
				        <button onClick="return confirm('Wilt u dit agenda item verwijderen?')">Verwijder</button>
				    {{ Form::close() }}
	    		</td>
	  		</tr>
	  	@endforeach
	  	</tbody>
	</table>
@stop