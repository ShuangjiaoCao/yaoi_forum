<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'HomeController@index', 'as' => 'home'));





Route::group(array('before' => 'guest'), function()
	{
		Route::get('create', array('uses' => 'UserController@getCreate', 'as' => 'getCreate'));
		Route::get('login', array('uses' => 'UserController@getLogin', 'as' => 'getLogin'));

		Route::group(array('before' => 'csrf'), function()
		{
			Route::post('create', array('uses' => 'UserController@postCreate', 'as' => 'postCreate'));
			Route::post('login', array('uses' => 'UserController@postLogin', 'as' => 'postLogin'));
		});
	});

Route::group(array('before' => 'auth'), function()
{
	Route::get('logout', array('uses' => 'UserController@getLogout', 'as' => 'getLogout'));
});	


Route::get('user/{id}/edit', array('before' => 'auth', 'as' => 'user.edit', function($id)
{
    if (Auth::user()->is_admin or Auth::id() == $id) {
        return View::make('users.edit')->with('user', User::find($id));
    } else {
        return Redirect::to('/');
    }
}));

Route::put('user/{id}', array('before' => 'auth|csrf', function($id)
{
    if (Auth::user()->is_admin or (Auth::id() == $id)) {
        $user = User::find($id);
        $rules = array(
            //'password' => 'required_with:old_password|min:6|confirmed',
            'pass1' => 'required|min:6',
			'pass2' => 'required|same:pass1',
            'old_password' => 'min:6',
        );
       
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes())
        {
            if (!(Input::get('old_password') == '')) {
                if (!Hash::check(Input::get('old_password'), $user->password)) {
                    return Redirect::route('user.edit', $id)->with('user', $user)->with('message', array('type' => 'danger', 'content' => '旧密码输错了'));
                } else {
                    $user->password = Hash::make(Input::get('pass1'));
                }
            }
           
            $user->save();
            return Redirect::route('user.edit', $id)->with('user', $user)->with('message', array('type' => 'success', 'content' => '修改成功'));
        } else {
            return Redirect::route('user.edit', $id)->withInput()->with('user', $user)->withErrors($validator);    
        }
    } else {
        return Redirect::to('/');
    }
}));



//Route::get('/', 'BlogController@index');


Route::resource('post', 'PostController');  


/*Route::get('/post/new', array(   //add a new article (the new post view)
  'as' => 'newPost',
  'uses' => 'PostController@create'
));

//Route::post('post/preview', array('before' => 'auth', 'uses' => 'PostController@preview'));



Route::post('/post/new', array(   //add a new article and clikck "post"
  'as' => 'createPost',
  'uses' => 'PostController@store'
));*/

Route::get('/post/{id}', array(
  'as' => 'viewPost',
  'uses' => 'BlogController@viewPost'
));

Route::post('/post/{id}/comment', array(
  'as' => 'createComment',
  'uses' => 'BlogController@createComment'
));
