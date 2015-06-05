@extends('template.skeleton')

@section('title')
{{ Auth::user()->username.' | '._('Today Report') }}
@stop

@section('content')

	<div class="container">

		<h1>{{ _('Today') }}</h1>
        <p>First checkin : {{ count($attends) > 0 ? $attends[0]->created_at : ''}}</p>

		@include('template.messages')

		<table id="enable_pagination" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                <thead><tr>
                	<th>{{ _('Checkin') }}</th>
                    <th>{{ _('Login From') }}</th>
                </tr></thead><tbody>
                @foreach ($attends as $attend)
                <tr>
                	<td>{{ $attend->created_at }}</td>
                    <td>{{ $attend->remote_addr }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
		
	</div>
@stop
