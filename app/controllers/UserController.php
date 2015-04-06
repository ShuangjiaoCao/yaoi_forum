<?php

class UserController extends BaseController
{


public function getPosts(User $user)
{
    return View::make('home')
    ->with('user', $user)
    ->with('posts', Post::with('tags,circle,charakters,cps'))
    	->where('user_id', '=', $user->id)
    	->orderBy('created_at', 'desc')
    	->paginate(15);
}


public function getFaveritePosts(User $user)
{

	$posts = $user->faverate_posts() ->orderBy('created_at', 'desc')
	 ->paginate(15);

	 return View::make('searchlists.normal')
	 ->with('posts', $posts);
	
	
    //return View::make('home')->with('user', $user)->with('posts', Post::with('tags')->where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->get());
}



public function addFaveritePost($id)
{
	$post = Post::with('circle','tags', 'cps', 'charakters')->find($id);
	$user = Auth::user();
	$user_post=	$user->faverate_posts()->where('post_id','=', $id)->first(); //the post with uders like
 	//$result = []; 


if($user_post!=null)
{    // if already liked
//var_dump("already liked!");
 $user->faverate_posts()->detach($post);
 $result = Array("response" => false);
 // $result['response'] = false;    // cancel the faverate
}else {
//var_dump("liked u!");
$user->faverate_posts()->save($post);
$result = Array("response" => true);       // like the post
 
}
$user->save();
    //$myfaverate = 
 //return Redirect::route('post.show', $post->id);
  return Response::json($result);
  //return $result;
    //return View::make('home')->with('user', $user)->with('posts', Post::with('tags')->where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->get());
}



	//gets the view for the register page
	public function getCreate()
	{
		return View::make('users.create');
	}

	//gets the view for the login page
	public function getLogin()
	{
		return View::make('users.login');
	}

	public function postCreate()
	{
		$validate = Validator::make(Input::all(), array(
			'email' => 'required|email|unique:users',
			'pass1' => 'required|min:6',
			'pass2' => 'required|same:pass1',
		));

		if ($validate->fails())
		{
			return Redirect::route('getCreate')->withErrors($validate)->withInput();
		}
		else
		{
			$user = new User();
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('pass1'));

			if ($user->save())
			{
				//return Redirect::route('home')->with('success', 'You registed successfully. You can now login.');
				return Redirect::route('getLogin')->with('message', array('type' => 'success', 'content' => '注册成功，请登录'));

				//return Redirect::to('login')->withInput()->with('message', 'E-mail or password error');
			
			}
			else
			{
				//return Redirect::route('home')->with('fail', 'An error occured while creating the user. Please try again.');
				return Redirect::route('getCreate')->withInput()->with('message', array('type' => 'danger', 'content' => '注册失败'));
			}
		}
	}

	public function postLogin()
	{
		$validator = Validator::make(Input::all(), array(
		'email' => 'required',
		'pass1' => 'required'
		));
		
		if($validator->fails())
		{
			return Redirect::route('getLogin')->withErrors($validator)->withInput();
		}
		else
		{
			$remember = (Input::has('remember')) ? true : false;

			$auth = Auth::attempt(array(
				'email' => Input::get('email'),
				'password' => Input::get('pass1')
				), $remember);

			if($auth)
			{
				return Redirect::intended('/');
			}
			else
			{
				//return Redirect::route('getLogin')->with('fail', 'You entered the wrong login credentials, please try again!');
				return Redirect::route('getLogin')->withInput()->with('message', array('type' => 'danger', 'content' => 'E-mail或者密码错了，请再试一次'));
			}
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::route('home');
	}
}