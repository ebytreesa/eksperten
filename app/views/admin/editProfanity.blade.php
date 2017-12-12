@extends('layout.home')

@section('title')
Edit profanity
@stop

@section('content')
<div class="container" style="width:70%;">
<center><h4>ADMIN PANEL</h4></center>
<h3>Edit profanity</h3>

	{{ Form::open(array('route' => 'postEditProfanity' )) }}
		{{ Form::hidden('id', $p->id) }} 

	<div class="form-group {{ ($errors->has('word')) ? 'has-error' : '' }}"><br>
		{{ Form::label('Word') }} 
		{{ Form::text('word', $p->word, array('class' => 'form-control', 'required' => 'required')) }}

		@if ($errors->has('word'))
			<strong>
			{{ $errors->first('word') }}
			</strong>
		@endif
		<br>
 	</div>

	{{ Form::submit('post', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}


@stop