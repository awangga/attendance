@extends('template.skeleton')

@section('title')
{{ _('About us') }}
@stop

@section('content')
	<div class="container">
		<h1>{{ _('About us') }}</h1>
		@include('template.messages')

		<div class="well">
			<p>Hubungi kami melalui Website kami <a href="http://www.saungit.org/" target="_blank">disini</a>.</p>
		</div>
	</div>	
@stop

