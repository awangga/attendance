@extends('template.skeleton')

@section('title')
{{ _('Absen') }}
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
			<br>
			<p class="col-xs-6 col-sm-4">
			{{ Form::open(array('url' => '/', 'method' => 'post', 'class'=> 'form-inline')) }}
			@if ($started == 0)
			{{ Form::submit('Start as '.$profile->first_name, array('class' => 'btn btn-success btn-lg')) }}
			@endif
			@if ($started == 1)
			{{ Form::submit('Stop as '.$profile->first_name, array('class' => 'btn btn-danger btn-lg')) }}
			@endif

        {{ Form::close() }}
        <a href="{{ url('login') }}"><span class="glyphicon glyphicon-remove"></span>{{ _("it's not me") }}</a></p>
			
		</div>
		@endif
	</div>	
@stop
