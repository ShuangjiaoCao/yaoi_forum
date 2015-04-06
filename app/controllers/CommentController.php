<?php

class CommentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /comment
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /comment/create
	 *
	 * @return Response
	 */
	public function createComment($id)
	{
		  
    // get the post that the user commented on
    $post = Post::findOrFail($id);

  $rules = [
        'name' => 'required',
        'content' => 'required',
   		//'tags'    => array('required', 'regex:/^\w+$|^(\w+,)+\w+$/'),
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->passes()) {
        $comment = Comment::create(Input::only('name','content'));        				  

    $comment->name = Input::get('name');

     


    $comment->content = nl2br(Input::get('content'));
    $comment->isUpdate = 0;  // normal comment
    // save the comment with a relation to the post
	$post ->updated_at =  $comment->updated_at; 

    $post->comments()->save($comment);	
    $comment->index =$post->comments()->count();
	

	$post ->save();
 	$comment->save(); 


//$posts = Comment::with('user', 'tags')->orderBy('created_at', 'desc')->paginate(5);
    // go back to the post
    //return Redirect::route('viewPost', array('id' => $post->id));
     return Redirect::route('post.show', $post->id);
     			
	} else {
        //return Redirect::route('article.create')->withInput()->withErrors($validator);
  //return Redirect::route('createPost')->withInput()->withErrors($validator);
      return Redirect::route('post.show', $post->id)->withInput()->withErrors($validator);
    }

	}

	public function createUpdate($id)
	{
		  
    // get the post that the user commented on
    $post = Post::findOrFail($id);

  $rules = [
        'content' => 'required',
   		//'tags'    => array('required', 'regex:/^\w+$|^(\w+,)+\w+$/'),
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->passes()) {
        $comment = Comment::create(Input::only('content'));        				  

    $comment->content = nl2br(Input::get('content'));
	$comment->isUpdate = 1;  // update

	 $comment->name = $post->name; 

	  if (Input::has('isEnd')){//0:end, 1: continue  如果点了，说明文章完结。和comment没关系
    $post->isEnd =  0;
    $post->save();

      }

    $comment->is18 =  (Input::has('is18'))? 1 : 0;  // 1:meat  点了说明次节有肉，没点说明没肉
	
    // save the comment with a relation to the post
    $post->comments()->save($comment);
    $post ->updated_at =  $comment->updated_at; 
 
    $comment->index =$post->comments()->count();

	$post ->save();
 	$comment->save(); 



//$posts = Comment::with('user', 'tags')->orderBy('created_at', 'desc')->paginate(5);
    // go back to the post
    //return Redirect::route('viewPost', array('id' => $post->id));
     return Redirect::route('post.show', $post->id);
     			
	}

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /comment
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /comment/{id}
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
	 * GET /comment/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /comment/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /comment/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}