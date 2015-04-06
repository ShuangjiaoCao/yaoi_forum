<?php

/**
 * SearchController is used for the "smart" search throughout the site.
 * it returns and array of items (with type and icon specified) so that the selectize.js plugin can render the search results properly
 **/
 
class SearchController extends BaseController {
 protected $layout = '_layouts.default';
protected $layout2 = 'search';


	public function appendValue($data, $type, $element)
	{
		// operate on the item passed by reference, adding the element and type
		foreach ($data as $key => & $item) {
			$item[$element] = $type;
		}
		return $data;		
	}
		
	public function appendURL($data, $prefix)
	{
		// operate on the item passed by reference, adding the url based on slug
		foreach ($data as $key => & $item) {
			$item['url'] = url($prefix.'/'.$item['slug']);
		}
		return $data;		
	}



public function getCiscleSearch()
        {
            //get keywords input for search
            $keyword=  Input::get('q');

            //search that student in Database
             $circles= Circle::find($keyword);

            //return display search result to user by using a view
            //return View::make('selfservice')->with('student', $students);
        }



public function getCharakterSearch()
        {
            $query = e(Input::get('q',''));

		if(!$query && $query == '') return Response::json(array(), 400);

		$charakters = Charakter::where('name','like','%'.$query.'%')
			->orderBy('name','asc')
			//->take(1)
			->get()
			->toArray();
			//->get(array('name'))->toArray();

		
		$data = $charakters;


		return Response::json(array(
			'data'=>$data
		));


        }



        public function getAutoCps()
        {
		
		$term = e(Input::get('term',''));
            //echo  "term:"  . $term;
		
		if(!$term && $term == '') return Response::json(array(), 400);

		$cps = Cp::where('name','like','%'.$term.'%')
			->orderBy('name','asc')
			->take(8)
			->get();
			
			$result =[];
					
			foreach ($cps as $cp) {
			$result[] = $cp->name;
		}
return Response::json($result);
  }

     public function getAutoTags()
        {
		
		$term = e(Input::get('term',''));
            //echo  "term:"  . $term;
		
		if(!$term && $term == '') return Response::json(array(), 400);

		$tags = Tag::where('name','like','%'.$term.'%')
			->orderBy('name','asc')
			->take(8)
			->get();
			
			$result =[];
					
			foreach ($tags as $tag) {
			$result[] = $tag->name;
		}
return Response::json($result);
  }



        public function getAutoCircle()
        {
		
		$term = e(Input::get('term',''));
            //echo  "term:"  . $term;
		
		if(!$term && $term == '') return Response::json(array(), 400);

		$circles = Circle::where('name','like','%'.$term.'%')
			->orderBy('name','asc')
			->take(8)
			->get();
			
			$result =[];
					
			foreach ($circles as $circle) {
			$result[] = $circle->name;
		}
return Response::json($result);
  }



        public function getAutoCharakters()
        {
		
		$term = e(Input::get('term',''));
            //echo  "term:"  . $term;
		
		if(!$term && $term == '') return Response::json(array(), 400);

		$charakters = Charakter::where('name','like','%'.$term.'%')
			->orderBy('name','asc')
			->take(8)
			->get();
			
			$result =[];
					
			foreach ($charakters as $charakter) {
			$result[] = $charakter->name;
		}
return Response::json($result);
  }



	public function index() {
    //return View::make('tags.list')->with('tags', Tag::all()->orderBy('count', 'desc'));

	return View::make('search');

}



	public function postNormalSearch()
	{
	    $q = Input::get('normal_search');
	    $searchtype=  Input::get('searchtype');      //get a bool


		if( $searchtype == 0 ){
			$posts = Post::where('title','like','%'.$q.'%')
				->orderBy('created_at', 'desc')
				->orderBy('name','asc')			
				->paginate(10);
		


			} else {
			$posts = Post::where('name','like','%'.$q.'%')
				->orderBy('created_at', 'desc')
				->orderBy('name','asc')	
				->paginate(10);


			

	}
 		


     //$posts = Post::with('user', 'name')->orderBy('created_at', 'desc')->paginate(5);
	 // $this->layout->content = View::make('searchlists.normal', compact('posts'));
 //$this->layout->content =  View::make('searchlists.normal')->with('posts',  $posts);
  $this->layout->search_content =  View::make('searchlists.normal')->with('posts',  $posts);

}



public function articles($id)
{
    $tag = Tag::find($id);
    $articles = $tag->articles()->orderBy('created_at', 'desc')->paginate(10);
    return View::make('articles.specificTag')->with('tag', $tag)->with('articles', $articles);
}



	public function postKomplexSearch() {
	
	$filter_posts = new Post;
	$filter_charakters = new Charakter;
	$filter_cps = new Cp;

	if (Input::has('circles_search')){       //如果填了圈子
		//$circle_q = Input::get('circle_search');
		$circle = Circle::where('name','=',  Input::get('circles_search'))   
					->first();    			//得到圈子

		$filter_charakters= $filter_charakters->where('circle_id','=', $circle->id); //得到该圈子的所有角色

		$filter_cps= $filter_cps->where('circle_id','=', $circle->id); //得到该圈子的所有CP

		$filter_posts= $filter_posts->where('circle_id','=', $circle->id); //得到该圈子的所有文章
			
		

	} else {
		$circle = null;

	}
	
	if (Input::has('charakters_search')){   //如果填了角色, 得到所有有这个角色的文章
		$charakter = Charakter::where('name','=',  Input::get('charakters_search'))   
					->first();    			//得到角色
		$filter_posts = $charakter->posts();     //该角色的所有文章


		                     


	} else {
		$charakter=null;

	}

	if (Input::has('cps_search')){   //如果填了CP, 得到所有有这个CP的文章
		$circle_q = Input::get('cps_search');
		$cp= Cp::where('name','=', Input::get('cps_search')) 
						->first(); 
		$filter_posts = $cp->posts();     //该CP的所有文章
		             
	} else {
		$cp=null;

	}


if (Input::has('tags_search')){   //如果填了TAG, 得到所有有这个TAG的文章
		$circle_q = Input::get('circle_search');
		$tag= Tag::where('name','=', Input::get('tags_search')) 
						->first(); 
		$filter_posts = $tag->posts();     //该TAG的所有文章
			
	} else {
		$tag = null;
	}

  

	if (Input::has('isEndSearch')){   //如果填了完结与否

	$status = Input::get('isEndSearch');   // 1 lian or 2 wan 0 none
	//$newBrands->where('isEnd', '=', $status);

	//$isEnd = ( $status == 1)  ?   "连载文":   "完结文";


	switch ($status) {
    case 0:

         $isEnd =  null;
        break;
    case 1:
        $isEnd =  "连载文";
         $filter_posts->where('isEnd','=', '1'); 
        break;
    case 2:
        $isEnd =  "完结文";
        $filter_posts->where('isEnd','=', '0'); 
	    break;
}


	
} else {
		$isEnd = null;

}
	
	$posts = $filter_posts ->orderBy('updated_at', 'desc')->paginate(15);
	$charakters = $filter_charakters ->orderBy('count', 'desc')->paginate(15);

	//var_dump($charakters);
	$cps = $filter_cps ->orderBy('count', 'desc')->paginate(15);	
	

	//$this->layout->search_content =  View::make('searchlists.normal')->with('posts',  $posts); 
	$this->layout->search_content =  View::make('searchlists.complex') 
							->with(
                            array(
                                'posts' => $posts,
                                'charakters' => $charakters,
                                'circle' => $circle,
								'charakter_input' => $charakter,
								'cp_input' => $cp,
								'tag_input' => $tag,
								'status' => $isEnd,
                                'cps' => $cps
                                
                                )
    );
	//$post = Post::where('circle_id','=','contacts.user_id');  //这个圈子的所有文章

			
	

}




}