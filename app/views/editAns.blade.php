@extends('layout.home')

@section('title')
Edit svar
@stop

@section('content')
@if (Auth::check() && (Auth::user()->admin == 1))
		<center><h4>Admin </h4></center>
@endif 
<div class="container" style="width:70%;">
<h3>Edit svar</h3>

{{ Form::open(array('route' => 'postEditAnswer' )) }}
 	 	
	<div class="form-group {{ ($errors->has('answer')) ? 'has-error' : '' }}"><br>
		{{ Form::hidden('id', $answer->id)}}
		{{ Form::textarea('answer', $answer->answer, array('class' => 'form-control')) }}

		@if ($errors->has('answer'))
			<strong>
			{{ $errors->first('answer') }}
			</strong>
		@endif
		<br>

 		{{ Form::submit('post', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop