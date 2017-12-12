<?php


Route::get('/', 'HomeController@index');

Route::get('/home/showQuestion/{id}', 'HomeController@showQuestion');

 Route::group(array('before' => 'guest'), function(){
	
	Route::get('/login', 'HomeController@login');
	Route::get('/register', 'HomeController@register');


	Route::group(array('before' => 'csrf'), function(){
		Route::post('/login', array('uses' => 'HomeController@postLogin', 'as' =>'postLogin'));
		Route::post('/register', array('uses' => 'HomeController@postRegister', 'as' =>'postRegister'));				
	});

 });

Route::group(array('before' => 'auth'), function(){
	Route::get('/home/addQuestion', 'HomeController@addQuestion');
	Route::get('/logout','HomeController@logout');
	Route::get('/deleteQuestion/{id}','HomeController@deleteQuestion');
	Route::get('/editQuestion/{id}','HomeController@editQuestion');
	Route::get('/deleteAnswer/{id}','HomeController@deleteAnswer');
	Route::get('/editAnswer/{id}','HomeController@editAnswer');
	Route::get('/acceptAns/{id}','HomeController@acceptAns');
	
	
	Route::group(array('before' => 'csrf'), function(){
		Route::post('/home/addQuestion', array('uses' => 'HomeController@postAddQuestion', 'as' =>'postAddQuestion'));
		Route::post('/editQuestion/{id}', array('uses' => 'HomeController@postEditQuestion', 'as' =>'postEditQuestion'));
		Route::post('/home/showQuestion/{id}', array('uses' => 'HomeController@postAnswer', 'as' =>'postAnswer'));
		// Route::post('/showQuestion/{id}', array('uses' => 'HomeController@postEditAnswer', 'as' =>'postEditAnswer'));
		Route::post('/editAnswer/{id}', array('uses' => 'HomeController@postEditAnswer', 'as' =>'postEditAnswer'));

	});

	Route::group(array('before' => 'admin'), function(){
		Route::get('/admin', 'AdminController@admin');
		Route::get('/admin/listCat', 'AdminController@listCat');
		Route::get('/admin/addCategory', 'AdminController@addCategory');
		Route::get('/admin/editCat/{id}', 'AdminController@editCat');
		Route::get('/admin/deleteCat/{id}', 'AdminController@deleteCat');
		
		Route::get('/admin/listQA', 'AdminController@listQA');
		Route::get('/admin/showQuestion/{id}', 'AdminController@showQuestion');
		Route::get('/admin/listUsers', 'AdminController@listUsers');
		Route::get('/admin/deleteUser/{id}','AdminController@deleteUser');
		Route::get('/admin/listProfanity', 'AdminController@listProfanity');
		Route::get('/admin/editProfanity/{id}', 'AdminController@editProfanity');
		Route::get('/admin/deleteProfanity/{id}', 'AdminController@deleteProfanity');
		
		Route::group(array('before' => 'csrf'), function(){		
			Route::post('/admin/listCat', array('uses' => 'AdminController@postAddCategory', 'as' =>'postAddCategory'));
			Route::post('/admin/editCat/{id}', array('uses' => 'AdminController@postEditCat', 'as' =>'postEditCat'));
			Route::post('/admin/listProfanity', array('uses' => 'AdminController@postAddProfanity', 'as' =>'postAddProfanity'));
			Route::post('/admin/editProfanity/{id}', array('uses' => 'AdminController@postEditProfanity', 'as' =>'postEditProfanity'));			
		});
	});
});