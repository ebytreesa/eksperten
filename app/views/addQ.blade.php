@extends('layout.home')

@section('title')
Oprett spørgsmål
@stop

@section('content')
<div class="container" style="width:70%;">
<h3>Oprett spørgsmål</h3>

{{ Form::open(array('route' => 'postAddQuestion' )) }}
	
	<div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}"><br>
		{{ Form::label('Title') }} 
		{{ Form::text('title', '', array('class' => 'form-control', 'required' => 'required')) }}

		@if ($errors->has('title'))
			<strong>
			{{ $errors->first('title') }}
			</strong>
		@endif
		<br>
 	</div>
	<div class="form-group {{ ($errors->has('question')) ? 'has-error' : '' }}"><br>
		{{ Form::label('Question') }} 
		{{ Form::textarea('question', '', array('class' => 'form-control', 'required' => 'required')) }}

		@if ($errors->has('question'))
			<strong>
			{{ $errors->first('question') }}
			</strong>
		@endif
		<br>
	</div>	
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
	</div>	
	<div class="form-group {{ ($errors->has('points')) ? 'has-error' : '' }}"><br>
		{{ Form::label('Points') }} 
		{{ Form::number('points', 10, array('class' => 'form-control', 'required' => 'required')) }}

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