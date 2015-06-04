@extends('template.skeleton')

@section('title')
{{ _('Home') }}
@stop

@section('content')
	<div class="container">
		@include('template.messages')

		@if(Cookie::get('domain_hash'))
		{{ $homepage }}
		@else
		
		
		
		<div class="well">
			
			<div id="clock" class="light">
			<div class="display">
				<div class="weekdays"></div>
				<div class="ampm"></div>
				<div class="alarm"></div>
				<div class="digits"></div>
			</div>
			</div>
			<p>Saya Masuk</p>
			
		</div>
		@endif
	</div>	
@stop
