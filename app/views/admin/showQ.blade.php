@extends('layout.home')

@section('title')
home
@stop


@section('content')
<center><h4>ADMIN PANEL</h4></center>

	<div style="border: 1px solid black; background-color:#eef2da ; padding: 5px;">
		<?php
			$user = User::where('id', $q->user_id)->first();
        ?>
     	<strong style="color:blue;"> af: {{ $user->username }} </strong>
		<h4>{{ $q->title }}</h4>
		<p> {{ $q->question }}</p>	
		<strong style="color:red;"> points: {{ $q->points }} </strong>	
	</div><br>

	<div>
		<?php
			$answers = Answer::where('q_id', $q->id)->get();
        ?>

		@foreach($answers as $answer )	
		<div  style="background-color:aliceblue; border: 1px solid red;padding: 5px; position: relative; padding: 10px;">
			<?php
			$username = User::where('id', $answer->user_id)->first()->username;
        	?>
       		<strong style="color:blue;"> af: {{ $username }} </strong>
       		
				<p >{{ $answer->answer }}</p>
					
					<a href="/deleteAnswer/{{ $answer->id }}" class="btn btn-danger btn-xs">delete</a>
					<a href="/editAnswer/{{ $answer->id }}" id="editAns" class="btn btn-info btn-xs">edit</a>
					
					
		</div>
			
		<br>
		@endforeach

	</div>
	

@stop