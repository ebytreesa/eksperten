@extends('layout.home')

@section('title')
login
@stop

@section('content')
<div class="container" style="width:70%;">
<h1>Login</h1>

{{ Form::open(array( 'route' => 'postLogin')) }}

<div class="form-group {{ ($errors->has('username')) ? ' has-error' : ''}}">
		{{ Form::label('Username') }}
		{{ Form::text('username', '' , array('class' => 'form-control')) }}
		@if ($errors->has('username'))
		<strong>
			{{ $errors->first('username') }}
		</strong>
		@endif
	</div>

	<div class="form-group {{ ($errors->has('password')) ? ' has-error': ''}}">
		{{ Form::label('Password') }}
		{{ Form::password('password',  array('class' => 'form-control' )) }}
		@if ($errors->has('password'))
		<strong>
			{{ $errors->first('password') }}
		</strong>
		@endif
	</div>
	{{ Form::submit('Login', array('class'  => 'btn btn-primary')) }}
{{ Form::close()}}

</div>
@stop