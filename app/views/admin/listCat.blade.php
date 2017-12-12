@extends('layout.home')

@section('title')
listCategories
@stop
@section('content')
<div class="row" style="padding-left:100px;">
<center><h4>ADMIN PANEL</h4></center>
<h3>Categories</h3>
<div>
	<table class="table table-responsive table-striped" style="border: 1px solid gray;">
  		<thead class="thead-inverse" style="background-color: black; color: white;">
    		<tr >
     			<th>#</th>
      			<th>Name</th>
      			<th>Edit</th>
      			<th>Slet</th>
      		</tr>
 		 </thead>
  		<tbody>
  		@foreach($cat as $cat)
  		  
    		<tr>
    			<td></td>
     			<td style="color: blue;"> {{ $cat->name }}</td>     				
     			<td><a href="/admin/editCat/{{ $cat->id }}" class="btn btn-info btn-xs">edit</td>
      			<td><a href="/admin/deleteCat/{{ $cat->id }}" class="btn btn-danger btn-xs">delete</a></td>
      			
   		    </tr>
   		@endforeach
   		</tbody>
    </table>
	
</div>

	
<a  id="show_formCat" class="btn " style="background-color: green; color:white;"> Oprette Category</a>

<div id="formCat" style="display: none;">
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
</div>

<script>
$(document).ready(function(){
   
    $("#show_formCat").click(function(){
        $("#formCat").show();
    });

});
</script>

@stop

