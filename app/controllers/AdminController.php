<?php

class AdminController extends BaseController {

	public function admin()
	{
		return View::make('admin.admin');
	}

	
	public function listUsers()
	{
		$users = User::get();
		return View::make('admin.listUsers')->withUsers($users);
	}

	public function deleteUser($id)
	{
		$answers = Answer::where('user_id',$id)->get();
		foreach($answers as $ans)
		{
		$ans->delete();
		}
		
		$questions = Question::where('user_id',$id)->get();
		foreach($questions as $q)
		{
		$q->delete();
		}

		User::destroy($id);
		
		return Redirect::back()->withSuccess('user blev slettet');
	}

	public function listCat()
	{
		$cat = Category::get();
		return View::make('admin.listCat')->withCat($cat);
	}


	public function addCategory()
	{		 
		return View::make('admin.addCategory');
	}

	public function postAddCategory()
	{
		$messages = array(
			'required' => ':attribute feltet skal udfyldes'
			);

		$validator = Validator::make(Input::All(),
			array(
				'name' =>'required'	), $messages);

		if ($validator->fails())
		{
			return Redirect::back()
			->withErrors($validator->messages())
			->withInput(Input::all());
		}else
		{	
			
			$cat 	= new Category;
			$cat->name = Input::get('name');
			$cat->save() ;
			
			return Redirect::back()->withSuccess('Ny category blev oprettet');
		}

	}

	public function editCat($id)
	{	
		$cat 	= Category::where('id', $id)->first();	 
		return View::make('admin.editCat')->withCat($cat);
	}

	public function postEditCat()
	{
		$messages = array(
			'required' => ':attribute feltet skal udfyldes'
			);

		$validator = Validator::make(Input::All(),
			array(
				'name' =>'required'	), $messages);

		if ($validator->fails())
		{
			return Redirect::back()
			->withErrors($validator->messages())
			->withInput(Input::all());
		}else
		{	
			
			$cat 	= Category::where('id', Input::get('id'))->first();
			$cat->name = Input::get('name');
			$cat->save() ;
			
			return Redirect::to('/admin/listCat')->withSuccess('category blev redegeret');
		}

	}


	public function deleteCat($id)
	{
		$questions = Question::where('cat_id',$id)->get();
		foreach($questions as $q)
		{
		$q->delete();
		}
		Category::destroy($id);
		return Redirect::back()->withSuccess('category slettet');
	}

	public function listProfanity()
	{
		$p = Profanity::get();
		return View::make('admin.listProfanity')->withP($p);
	}

	public function addProfanity()
	{		 
		return View::make('admin.addCategory');
	}

	public function postAddProfanity()
	{
		$messages = array(
			'required' => ':attribute feltet skal udfyldes'
			);

		$validator = Validator::make(Input::All(),
			array(
				'word' =>'required'	), $messages);

		if ($validator->fails())
		{
			return Redirect::back()
			->withErrors($validator->messages())
			->withInput(Input::all());
		}else
		{	
			
			$p 	= new Profanity;
			$p->word = Input::get('word');
			$new_word = preg_replace('/(?!^)\S/', " * ", $p->word);
			$p->replacement = $new_word;
			$p->save() ;
			
			return Redirect::back()->withSuccess('Ny bandeord blev oprettet');
		}

	}

	public function editProfanity($id)
	{	
		$p 	= Profanity::where('id', $id)->first();	 
		return View::make('admin.editProfanity')->withP($p);
	}

	public function postEditProfanity()
	{
		$messages = array(
			'required' => ':attribute feltet skal udfyldes'
			);

		$validator = Validator::make(Input::All(),
			array(
				'word' =>'required'	), $messages);

		if ($validator->fails())
		{
			return Redirect::back()
			->withErrors($validator->messages())
			->withInput(Input::all());
		}else
		{	
			
			$p 	= Profanity::where('id', Input::get('id'))->first();
			$p->word = Input::get('word');
			$p->save() ;
			
			return Redirect::to('/admin/listProfanity')->withSuccess(' ord blev redegeret');
		}

	}

	public function deleteProfanity($id)
	{
		Profanity::destroy($id);
		return Redirect::back()->withSuccess('bandeord slettet');
	}



	public function listQA()
	{
		
		$questions = Question::get();
		return View::make('admin.listQA')->withQuestions($questions);
	}

	public function showQuestion($id)
	{
		$q 	= Question::where('id', $id)->first();
		return View::make('admin.showQ')->withQ($q);
	}

}