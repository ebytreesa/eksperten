@extends('layout.home')

@section('title')
Oprett category
@stop

@section('content')
<div class="container" style="width:70%;">
<center><h4>ADMIN PANEL</h4></center>
<h3>Oprett category</h3>

{{ Form::open(array('route' => 'postAddCategory' )) }}
	
	<div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}"><br>
		{{ Form::label('Name') }} 
		{{ Form::text('name', '', array('class' => 'form-control', 'required' => 'required')) }}

		@if ($errors->has('name'))
			<strong>
			{{ $errors->first('name') }}
			</strong>
		@endif
		<br>
 	</div>

	{{ Form::submit('post', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}


@stop