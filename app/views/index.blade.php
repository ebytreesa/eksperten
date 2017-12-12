@extends('layout.home')

@section('title')
home
@stop


@section('content')
<div >
<br><br>
  <h3 style="display:inline; height: 40px; ">Seneste sprogsmål</h3>
  
  <a href="/home/addQuestion" class="btn pull-right" style="float:right; background-color: green; color:white; height: 30px;" >Opret sprøgsmål</a>
  </div>
  <br>
  <div class="row">

  <table class="table table-responsive table-striped" style="border: 1px solid gray;">
      <thead class="thead-inverse" style="background-color: black; color: white;">
        <tr >
          <th>#</th>
            <th>Title</th>
            <th>Category</th>
            <th>Indlæg</th>
             <th>points</th>
            <th>Oprettet</th>
            

        </tr>
     </thead>
      <tbody>
      @foreach($questions as $q)
        <tr>
          <td></td>
          <td><a href="/home/showQuestion/{{ $q->id }}">{{ $q->title}}</a>
            <?php
              $user = User::where('id', $q->user_id)->first();
              ?>
            <p style="color:blue;"> af: {{ $user->username }} </p>

            @if( Auth::check() && (Auth::user()->id == $q->user_id) )
              <a href="/deleteQuestion/{{ $q->id }}" class="btn btn-danger btn-xs">delete</a>
             <a href="/editQuestion/{{ $q->id }}" class="btn btn-info btn-xs">edit</a>
            @endif
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
          <td>{{ $q->points }}</td>
          <td>{{ $q->created_at}}</td>
          
        </tr>
      @endforeach
      </tbody>
    </table>
</div>
	<center>{{ $questions->links() }}</center>

@stop
