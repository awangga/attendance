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
		<div id="clock" class="light">
			<div class="display">
				<div class="weekdays"></div>
				<div class="ampm"></div>
				<div class="alarm"></div>
				<div class="digits"></div>
			</div>
		</div>
		
		<div class="well">
			<p>Ngikut homepage</p>
			
			<p>Ini merupakan home page yang kekinian, simple tapi cetar membahana. Pastikan anda memakainya kalo tidak sangat sangat rugi</p>
			
			<p>Edit this page by editing <strong>app/views/home.blade.php</strong></p>
		</div>
		@endif
	</div>	
@stop
