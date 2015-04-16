<?php

class CircleController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('auth', array('only' => array('create', 'store', 'edit', 'update', 'destroy')));
		$this->beforeFilter('mycsrf', array('only' => array('store', 'update', 'destroy')));
	}

	public function posts($id)
	{
		$circle = Circle::find($id);
		$posts = $circle->posts()->orderBy('updated_at', 'desc')->paginate(15);
		return View::make('articles.specialTags')->with('tag', $circle)->with('posts', $posts);
	}

	/**
	 * Display a listing of the resource.
	 * GET /circle
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('tags.list')->with('circles', Circle::where('count', '>', '0')->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->get());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /circle/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /circle
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /circle/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /circle/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('tags.circle.edit')->with('circle', Circle::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /circle/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'name' => array('required'),
		);
		$validator = Validator::make(Input::only('name'), $rules);
		if ($validator->passes()) {

			//$oldTag = Tag::find($id);    //如果这个新改的tag和以前数据库的tag重名
			$circle = Circle::find($id); 

			$existCircle= Circle::where('name', '=', Input::get('name')) -> first();
			 if( $existCircle != null ) {        //如果重名
				
			
 				$existCircle->count += $circle->count; 
 				
 				//$circle->name =  $existCircle->name;

 				//$posts =Post::where('circle_id','=', $circle->id)->first();
 				foreach ($circle->posts as $post) {    //所有属于这个要删圈子的帖子
 		      $existCircle->posts()->save($post);
 		      $post->circle_id = $existCircle->id;
 				}

 				foreach ($circle->cps as $cp) {    
 		      $existCircle->cps()->save($cp);
 		      $cp->circle_id = $existCircle->id;
 				}

 				foreach ($circle->charakters as $charakter) {    
 		      $existCircle->charakters()->save($charakter);
 		      $charakter->circle_id = $existCircle->id;
 				}


				$existCircle->save();	
				
		        $circle->delete();
		     
					return Redirect::to('/');
				


			 }  else {

			 	$circle->name =  Input::get('name');
			 	$circle->save();
			 	//return Redirect::back()->with('message', array('type' => 'success', 'content' => '修改成功'));
				//return  Redirect::to 
  				return Redirect::back()->with('message', array('type' => 'success', 'content' => '修改成功'));
			
				//Circle::find($id)->update(Input::only('name'));



			 }

			
		} else {
			return Redirect::back()->withInput()->withErrors($validator);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /circle/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$circle = Circle::find($id);
		
		
		foreach ($circle->posts as $post) {
			$post->circle_id = 5; //无
			$post->save();
		}
			$circle->delete();
		return Redirect::back();
	}
}