@extends('layout.home')

@section('title')
Bandeords
@stop
@section('content')
<div class="row" style="padding-left:100px;">
<center><h4>ADMIN PANEL</h4></center>

<h3>Bandeords</h3>
<div>
	<table class="table table-responsive table-striped" style="border: 1px solid gray;">
  		<thead class="thead-inverse" style="background-color: black; color: white;">
    		<tr >
     			<th>#</th>
      			<th>word</th>
      			<th>Edit</th>
      			<th>Slet</th>
      		</tr>
 		 </thead>
  		<tbody>
  		@foreach($p as $p)
  		  
    		<tr>
    			<td></td>
     			<td style="color: blue;"> {{ $p->word }}</td>     				
     			<td><a href="/admin/editProfanity/{{ $p->id }}" class="btn btn-info btn-xs">edit</td>
      			<td><a href="/admin/deleteProfanity/{{ $p->id }}" class="btn btn-danger btn-xs">delete</a></td>
      			
   		    </tr>
   		@endforeach
   		</tbody>
    </table>
	
</div>

	
<a  id="show_formP" class="btn " style="background-color: green; color:white;"> Oprette bandeord</a>

<div id="formP" style="display: none;">
{{ Form::open(array('route' => 'postAddProfanity' )) }}
	
	<div class="form-group {{ ($errors->has('word')) ? 'has-error' : '' }}"><br>
		{{ Form::label('Word') }} 
		{{ Form::text('word', '', array('class' => 'form-control', 'required' => 'required')) }}

		@if ($errors->has('word'))
			<strong>
			{{ $errors->first('word') }}
			</strong>
		@endif
		<br>
 	</div>

	{{ Form::submit('post', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}
</div>

<script>
$(document).ready(function(){
   
    $("#show_formP").click(function(){
        $("#formP").show();
    });

});
</script>

@stop