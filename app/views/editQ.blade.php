@extends('layout.home')

@section('title')
Edit spørgsmål
@stop

@section('content')
<div class="container" style="width:70%;">
 @if (Auth::check() && (Auth::user()->admin == 1))
		<center><h4>Admin </h4></center>
		@endif 
<h3>Edit spørgsmål</h3>

{{ Form::open(array('route' => 'postEditQuestion' )) }}
 	{{ Form::hidden('id', $q->id) }} 
	    <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}"><br>
			{{ Form::label('Title') }} 
			{{ Form::text('title', $q->title, array('class' => 'form-control', 'required' => 'required')) }}

				@if ($errors->has('title'))
					<strong>
					{{ $errors->first('title') }}
					</strong>
				@endif
		<br>

		{{ Form::textarea('question', $q->question, array('class' => 'form-control', 'required' => 'required')) }}

		@if ($errors->has('question'))
			<strong>
			{{ $errors->first('question') }}
			</strong>
		@endif
		<br>

		<div class="form-group">
	{{ Form::label('Category') }}
	<select name="cat">		
			<?php
			$cat =Category::get();
			?>
			@foreach($cat as $cat)
			<option value="{{ $cat->id }}" data="{{ $cat->id }}">{{ $cat->name }}</option>
			@endforeach
		
	</select>

		<div class="form-group {{ ($errors->has('points')) ? 'has-error' : '' }}"><br>
		{{ Form::label('Points') }} 
		{{ Form::number('points', $q->points, array('class' => 'form-control', 'required' => 'required')) }}

		@if ($errors->has('points'))
			<strong>
			{{ $errors->first('points') }}
			</strong>
		@endif
		<br>
	</div>	

 		{{ Form::submit('post', array('class' => 'btn btn-primary')) }}
		

{{ Form::close() }}
@stop