<?php

class HomeController extends BaseController {


	protected $layout = '_layouts.default';

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		//return View::make('index');
		//return  View::make('index', array(
      	 //'posts' => Post::all() ));

		 //$this->layout->content = View::make('index', array(
      	 //'posts' => Post::all() ));

//DB::select(DB::raw('RENAME TABLE photos TO images'));
/*
$querry = DB::raw(
	'SELECT * 
	 FROM posts AS a 
	 LEFT JOIN (SELECT comments.post_id,max([time]) AS [time] 
	 FROM comments 
	 GROUP BY comments.post_id) AS b 
	 ON a.id = b.post_id 
	 ORDER BY isnull(b.[time],a.[time]) DESC');*/


			

/*
$posts = Post::select('posts.*')
	->leftJoin('comments', 'comments.post_id', '=', 'posts.id')
    //->with('tags','user','comments')
  
    ->orderBy('comments.updated_at', 'desc')
    ->distinct()*/

   // Delete from tablename where id not in (select max(id) from tablename group by col1,col2,...)  (id是自增int)
    //->where(count('posts.id') ,'>', 1) 
  
//delete from T where T.rowid!=(select max(rowid) from T  t where student.A=t.A and student.B=t.B and student.C=t.C);




$posts = Post::with('tags','user','comments')
       //->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
        //->orderBy(DB::raw('COUNT(posts.id)'))
       //->distinct()
       ->orderBy('updated_at'  , 'desc') 
      // ->orderBy('posts.updated_at', 'desc')
         //TODO 有重复！！尼玛奇怪。distinct之后乱排！
    	//->distinct()
        
        //->select('posts.id')
        //->get();

        ->paginate(15);


	 	//->get();
//Goup by version.

	//$posts2 = DB::select($querry);


	
	


/*$posts = Posts::join('comments', 'comments.post_id', '=', 'posts.id')
        ->orderBy('comments.updated_at')
        ->paginate(10);*/


    $tags = Tag::where('count', '>', '0')->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->take(10)->get();
    

       // ->get(array('comments.field1 as field1', 'posts.field2 as field2'));




    return View::make('index')->with('posts', $posts)->with('tags', $tags);
//return View::make('searchlists.complex');


	}




	


}
