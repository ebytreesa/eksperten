@extends('layout.home')

@section('title')
home
@stop
@section('content')

<center><h4>ADMIN PANEL</h4></center>
<h3 style="display:inline; height: 40px; ">Sprogsmål</h3><br>
<table class="table table-responsive table-striped" style="border: 1px solid gray; margin-top: 20px;">
  		<thead class="thead-inverse" style="background-color: black; color: white;">
    		<tr >
     			<th>#</th>
      			<th>Title</th>
             <th>Category</th>
            <th>Indlæg</th>
            <th>points</th>
            <th>Oprettet</th>        
            <th>Slet</th>
            <th>edit</th>
      		</tr>
 		 </thead>
  		
  		@foreach($questions as $q)
      <tbody>
        <tr>
          <td></td>
          <td><a href="/admin/showQuestion/{{ $q->id }}">{{ $q->title}}</a>
            <?php
              $user = User::where('id', $q->user_id)->first();
              ?>
            <p style="color:blue;"> af: {{ $user->username }} </p>       
          </td> 

          <td>
             <?php
              $cat = Category::where('id', $q->cat_id)->first();
              ?>
              {{ $cat->name}} 
           </td>
         

          <td>
             <?php
              $count = Answer::where('q_id', $q->id)->count();
              ?>
              {{ $count }}
          </td>
          <td>{{ $q->points}}</td>
          <td>{{ $q->created_at}}</td>    
          <td> <a href="/deleteQuestion/{{ $q->id }}" class="btn btn-danger btn-xs">delete</a></td>
          <td> <a href="/editQuestion/{{ $q->id }}" class="btn btn-info btn-xs">edit</a></td>
        </tr>
       
        </tbody>
      @endforeach
   		
    </table>

@stop