@extends('layout.home')

@section('title')
home
@stop
@section('content')
<center><h4>ADMIN PANEL</h4></center>
<h3>User List</h3>
<table class="table table-responsive table-striped" style="border: 1px solid gray;">
  		<thead class="thead-inverse" style="background-color: black; color: white;">
    		<tr >
     			<th>#</th>
      			<th>Username</th>
      			<th>Email</th>
            <th>points</th>
      			<th>Slet</th>
      		</tr>
 		 </thead>
  		<tbody>
  		@foreach($users as $user)
    		<tr>
    			<td>#</td>
     			<td> {{ $user->username }}</td>     				
     			<td>{{ $user->email}}</td>
          <td>{{ $user->points}}</td>
      			<td><a href="/admin/deleteUser/{{ $user->id }}" class="btn btn-danger btn-xs">delete</a></td>
      			
   		    </tr>
   		@endforeach
   		</tbody>
    </table>

@stop