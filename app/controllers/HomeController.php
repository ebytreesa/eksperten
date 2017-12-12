<?php

class HomeController extends BaseController {

	

	public function index()
	{

		$questions	= Question:: OrderBy('created_at','DESC')->paginate('10');
		return View::make('index')->withQuestions($questions);
	}

	public function register()
	{
		return View::make('register');
	}

	public function postRegister()
	{
		$messages	= array(
			'required'	=> ':attribute feltet skal udfyldes',
			'email'	=> 'skriv en gyldig email adresse',
			'unique'=> 'brugernavnet er optaget',
			'same'	=> 'koderne er ikke ens',
			'min'	=> ':attribute feltet skal være min 6 tegn'
			);
		$validator	= Validator::make(Input::All(), array(
			'username'	=> 'required|unique:users',
			'email'	=> 'required|email',
			'pass1'	=>	'required|min:6',
			'pass2'	=>	'required|same:pass1'
			), $messages);
		if ($validator->fails())
		{
			return Redirect::to('/register')
					->withErrors($validator->messages())
					->withInput(Input::all());
		}else
		{ 
			$user = new User;
			$user->username= Input::get('username');
			$user->email= Input::get('email');
			$user->password	= Hash::make(Input::get('pass1'));
			$user->points = 100;
			$user->save();
				
		}
		if ($user)
		{
			return Redirect::to('/')->withSuccess('Brugeren blev oprettet');
		}else
		{
			return "der opstod en fejl";
		}

	}

	public function login()
	{
		return View::make('login');
	}

	public function postLogin()
	{
		$messages	= array(
			'required'	=> ':attribute feltet skal udfyldes'
			);
		$rules = array(
				'username' => 'required',
				'password' => 'required'
				);
		$validator = Validator::make(Input::all(), $rules, $messages);
		if ($validator->fails())
		{
			return Redirect::to('/login')->withError('login failed');
		}else
		{
			$userdata = array(
				'username' => Input::get('username'),
				'password' => Input::get('password')
				);
			if(Auth::attempt($userdata))
			{
				return Redirect::to('/')->withSuccess('You are now logged in');
			}else
			{
				return Redirect::to('/login')->withError('email or password invalid');
			}
				
		}
	}

	public function logout()
		{
			Auth::logout();
			return Redirect::to('/')->withSuccess('you are logged out');
		}

	public function addQuestion()
	{ 
		return View::make('addQ');
	}

	public function showQuestion($id)
	{
		$q 	= Question::where('id', $id)->first();
		return View::make('showQ')->withQ($q);
	}

	public function postAddQuestion(){
		$messages = array(
			'required' => ':attribute feltet skal udfyldes',
			'digits_between' =>'enter a value between 10 and 100'
			);

		$validator = Validator::make(Input::All(),
			array(
				'title' =>'required',
				'question' => 'required',				
				'points' => 'required|between:10,100|integer'
				), $messages);

		if ($validator->fails())
		{
			return Redirect::back()
			->withErrors($validator->messages())
			->withInput(Input::all());
		}else
		{	
			$user_id = Auth::user()->id;
			$question 	= new Question;
			$question->user_id = $user_id;			
			$question->cat_id = Input::get('cat');
			$question->title = Input::get('title');
			$question->question = Input::get('question');
			$question->points = Input::get('points');			
			$question->save() ;
			
			return Redirect::to('/')->withSuccess('Ny question blev oprettet');
		}

	}

	public function editQuestion($id)
	{
		$q = Question:: where('id', $id)->first();
		return View::make('editQ')->withQ($q);
	}

	public function postEditQuestion()
	{
		$messages = array(
			'required' => ':attribute feltet skal udfyldes',
			'digits_between' =>'enter a value between 10 and 100'			
			);
		$validator = Validator::make(Input::All(),
			array(
				'title' =>'required',
				'question' => 'required',
				'points' => 'required|between:10,100|integer'
				), $messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator->messages())->withInput(Input::all());
		}else
		{	
			// $user_id = Auth::user()->id;
			$question 	= Question::where('id', Input::get('id'))->first();
			// $question->user_id = $user_id;
			$question->title = Input::get('title');
			$question->cat_id = Input::get('cat');
			$question->question = Input::get('question');	
			$question->points = Input::get('points');			
			$question->save() ;
			if(Auth::user()->admin == 1)
			{
				return Redirect::to('/admin/listQA')->withSuccess(' question blev redegeret af admin');
			}else
			{
					
				return Redirect::to('/')->withSuccess(' question blev redegeret');
			}
			
		}

	}
	public function deleteQuestion($id)
	{
		Question::destroy($id);
		return Redirect::back()->withSuccess('spørgsmål slettet');
	}

	public function postAnswer()
	{
		$messages = array(
			'required' => ':attribute feltet skal udfyldes'			
			);

		$validator = Validator::make(Input::All(),
			array(
				'answer' =>'required'				
				), $messages);

		if ($validator->fails())
		{
			return Redirect::back()
			->withErrors($validator->messages())
			->withInput(Input::all());
		}else
		{	
		$answer = new Answer;
		$answer->q_id = Input::get('id');
		$string = Input::get('answer');
		$string_to_array = preg_split('/(\W+)/', $string, -1,  PREG_SPLIT_DELIM_CAPTURE);
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
		
		$new_answer = implode('', $string_to_array);
		$answer->answer = $new_answer;
		$answer->user_id = Auth::user()->id;
		$answer->save();
		return Redirect::back()->withSuccess('svar blev oprettet');
		}
	}

	public function editAnswer($id)
	{

		$answer = Answer:: where('id', $id)->first();
		return View::make('editAns')->withAnswer($answer);

	}

	public function postEditAnswer()
	{
		$messages = array(
			'required' => ':attribute feltet skal udfyldes'			
			);
		$validator = Validator::make(Input::All(),
			array(
				'answer' => 'required'				
				), $messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator->messages())->withInput(Input::all());
		}else
		{	
			// $user_id = Auth::user()->id;
			$answer 	= Answer::where('id', Input::get('id'))->first();
			// $answer->user_id = $user_id;
			$id = Question::where('id',$answer->q_id )->first()->id;
			$answer->q_id = $id;
			$string = Input::get('answer');
			$string_to_array = preg_split('/(\W+)/', $string, -1,  PREG_SPLIT_DELIM_CAPTURE);
			
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
		
			$new_answer = implode('', $string_to_array);
			$answer->answer = $new_answer;	

			$answer->save() ;
			
			
			return Redirect::to('home/showQuestion/'.$id)->withSuccess('svar blev redegeret');
		}

	}

	public function deleteAnswer($id)
	{
		Answer::destroy($id);
		return Redirect::back()->withSuccess('svar blev slettet');
	}

	public function acceptAns($id)
	{

		$answer = Answer::where('id', $id)->first();
		$q = Question::where('id',$answer->q_id)->first();
		$q_point = $q->points;
		$user_id = $answer->user_id;
		$user = User::where('id',$user_id)->first();
		$user_point = $user->points;
		$user->points = $user_point + $q_point ;
		$user->save();
		$user2 = User::where('id',$q->user_id)->first();
		$user2->points = $user2->points - $q_point;
		$user2->save() ;
		
		return Redirect::back()->withSuccess('svar blev godkendt');

	}

	

}
