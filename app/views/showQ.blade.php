@extends('layout.home')

@section('title')
home
@stop


@section('content')
	<div style="border: 1px solid black; background-color:#eef2da ; padding: 5px;">
		<?php
			$user = User::where('id', $q->user_id)->first();
        ?>
     	<strong style="color:blue;"> af: {{ $user->username }} </strong>
		<h4>{{ $q->title }}</h4>
		{{-- <p> {{ $q->question }}</p> --}}	
		
	{{-- ([\s\.,\/]) --}}
	  <?php		

		$string = $q->question;			
		 // $string_to_array = explode(" ", $string);
		$string_to_array = preg_split('/(\W+)/', $string, -1,  PREG_SPLIT_DELIM_CAPTURE);
		// var_dump($string_to_array);

		foreach ($string_to_array as $string_word)
		{			
			$badWord = Profanity::where('word', $string_word)->first();
			if($badWord)
			{
				$word_found = $badWord->word;	
				
				$new_word = preg_replace('/(?!^)\S/', "*", $word_found);
				

				$key = array_search($word_found, $string_to_array);
				
				$replace = array($key => $new_word);
				$string_to_array = array_replace($string_to_array, $replace) ;
			}	
		
		}			
		echo "<br>";
		$new_question = implode('', $string_to_array);
					
	?>
	{{ $new_question }}

	<br>

	<strong style="color:red;"> points: {{ $q->points }} </strong><br>
	<?php
              $cat = Category::where('id', $q->cat_id)->first();
              ?>
             <strong style="color:blue;"> Category:{{ $cat->name }}</strong>	
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
					@if( Auth::check() && (Auth::user()->id == $answer->user_id) )
					<a href="/deleteAnswer/{{ $answer->id }}" class="btn btn-danger btn-xs">delete</a>
					<a href="/editAnswer/{{ $answer->id }}" id="editAns" class="btn btn-info btn-xs">edit</a>
					@endif
					@if( Auth::check() && (Auth::user()->id == $q->user_id) )
			          <a href="/acceptAns/{{ $answer->id }}" class="btn btn-success btn-sm" style="margin: 10px;">Godkendt</a>
			        @endif
		</div>
			
		<br>
		@endforeach

	</div>
	<a href="#" id="show_form" class="btn " style="background-color: green; color:white;" >Opret svar</a>
	
	<div id="form" style="display: none;">
	{{ Form::open(array('route' => 'postAnswer' )) }}
	 	
	<div class="form-group {{ ($errors->has('answer')) ? 'has-error' : '' }}"><br>
		{{ Form::hidden('id', $q->id)}}
		{{ Form::textarea('answer', '', array('class' => 'form-control', 'required' => 'required')) }}

		@if ($errors->has('answer'))
			<strong>
			{{ $errors->first('answer') }}
			</strong>
		@endif
		<br>

 		{{ Form::submit('post', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}

	</div>

<script>
$(document).ready(function(){
   
    $("#show_form").click(function(){
        $("#form").show();
    });

});

// $(document).ready(function(){
   
//     $("#editAns").click(function(){

//         $("#hideAns").hide();
//         $("#showAns").show();
        
//     });
// });


</script>

@stop