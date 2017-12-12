@extends('layout.home')

@section('title')
register
@stop

@section('content')
<div class="container" style="width:70%;">
<h1>Register</h1>


{{ Form::open(array('route' => 'postRegister')) }}

	<div class="form-group {{ ($errors->has('username')) ? 'has-error' : '' }}">
		{{ Form::label('Username') }}
		{{ Form::text('username', '', array('class' => 'form-control')) }}
		@if ($errors->has('username'))
			<strong>
				{{ $errors->first('username') }}
			</strong>
		@endif
		</div>
		<br>
		

		
	<div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
		{{ Form::label('Email') }}
		{{ Form::email('email', '', array('class' => 'form-control')) }}
		@if ($errors->has('email'))
			<strong>
				{{ $errors->first('email') }}
			</strong>
		@endif
		</div>
		<br>

		<div class="form-group {{ ($errors->has('pass1')) ? 'has-error' : '' }}">
		{{ Form::label('Password') }}
		{{ Form::password('pass1',  array('class' => 'form-control')) }}
		@if ($errors->has('pass1'))
			<strong>
				{{ $errors->first('pass1') }}
			</strong>
		@endif
		</div>
		<br>

		<div class="form-group {{ ($errors->has('pass2')) ? 'has-error' : '' }}">
		{{ Form::label('Password igen') }}
		{{ Form::password('pass2',  array('class' => 'form-control')) }}
		@if ($errors->has('pass2'))
			<strong>
				{{ $errors->first('pass2') }}
			</strong>
		@endif
		</div>
		<br>
		{{ Form::submit('Opret bruger', array('class' => 'btn btn-primary')) }}
{{ Form::close()}}

</div>
@stop