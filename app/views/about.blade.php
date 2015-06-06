@extends('template.skeleton')

@section('title')
{{ _('About us') }}
@stop

@section('content')
	<div class="container">
		<h1>{{ _('About us') }}</h1>
		@include('template.messages')

		<div class="well">
			<p>Visit our Website in <a href="http://www.saungit.org/" target="_blank">here</a>. For any support version just contact awangga@passionit.co.id</p>
		</div>
	</div>	
@stop

