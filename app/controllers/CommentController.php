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

public function addNestComment()
	{
		$data = Input::all();
		 
  		$rules = [
        'comment_name' => 'required',
        'comment_content' => 'required',
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->passes()) {





		if(Request::ajax())
        {    
            //$id = Input::get('id');  

            
			$parent_comment_id = $data['parent_comment_id']; // the parent comment id
           // $comment = Comment::where('id', $comment_id)->first();
            $comment = Comment::findOrFail($parent_comment_id);  // ge the parent comment
            $post = Post:: where("id", "=",  $comment->post_id) -> first();  //find the father post

  			//$child_comment = Comment::create('name','content');
  			$child_comment = Comment::create(Input::only('comment_name','comment_content'));  



            //$children = $comment->children()->get();
            //var_dump($data['comment_name']);
            $child_comment->name = $data['comment_name'];   
            $child_comment->content = $data['comment_content'];  // the child comment content
          	$child_comment->parent_id =  $parent_comment_id;
            //$child_comment->post_id =  $post->id;
            $child_comment->save(); 

           $result = array(	
      	'name' =>  $child_comment->name,
      	'content' =>  $child_comment->content,
      	'time' =>  $child_comment->updated_at->timezone('Asia/Shanghai') ->format('Y-m-d H:i:s'),
    	);
			
			//var_dump( $result['time']);

   			$comment->children()->save($child_comment);

   			$post->updated_at = $child_comment->updated_at;
   			//$post->comments()->save($child_comment);	  			
            $comment->update();

            $post->update();






            $post ->updated_at =  $child_comment->updated_at; 



		

 			return Response::json($result); 
 		} 
 			
            
       }else { 
       //	var_dump($validation->messages());
       return Redirect::route('post.show', $post->id)->withInput()->withErrors($validator);
		//return Response::json($validator->errors()->getMessages(), 400);
 //return Response::json(array(
   //     'success' => false,
     //   'errors' => $validator->getMessageBag()->toArray()

    //), 400);
 				//return Response::json($validation->messages(), 500);
 			}

         

       // return Redirect::route('post.show', $post->id);
	}





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

if(Auth::check() && Auth::user()->is_admin){
 $comment->is_admin = 1;
  

}



     $comment->content = nl2br(Markdown::parse(  Input::get('content')));

    //$comment->content = nl2br(Input::get('content'));
    $comment->isUpdate = 0;  // normal comment
    // save the comment with a relation to the post
	$post ->updated_at =  $comment->updated_at; 

    $post->comments()->save($comment);	
    $comment->index =$post->comments()->count();
	

	$post ->save();
 	$comment->save(); 
     return Redirect::back()->withInput();
     			
	} else {
        //return Redirect::route('article.create')->withInput()->withErrors($validator);
  //return Redirect::route('createPost')->withInput()->withErrors($validator);
      return Redirect::route('post.show', $post->id)->withInput()->withErrors($validator);
    }

	}

	public function createUpdate($id)
	{
		  function nl2p($text) {

    return "<p>" . str_replace("\n", "</p><p>", $text) . "</p>";

  }
    // get the post that the user commented on
    $post = Post::findOrFail($id);

  $rules = [
        'content' => 'required',
   		//'tags'    => array('required', 'regex:/^\w+$|^(\w+,)+\w+$/'),
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->passes()) {
        $comment = Comment::create(Input::only('content'));

 $comment->content = nl2p(Input::get('content'));
   // $comment->content = nl2br(Input::get('content'));
	$comment->isUpdate = 1;  // update

	 $comment->name = $post->name; 
   
if(Auth::check() && Auth::user()->is_admin){
 $comment->is_admin = 1;
  

}

	  if (Input::has('isEnd')){//0:end, 1: continue  如果点了，说明文章完结。和comment没关系
    $post->isEnd =  0;
    $post->save();

      }

    $comment->is18 =  (Input::has('is18'))? 1 : 0;  // 1:meat  点了说明次节有肉，没点说明没肉
	
    // save the comment with a relation to the post
    $post->comments()->save($comment);
    $post ->updated_at =  $comment->updated_at; 
 
    $comment->index =$post->comments()->count();  //楼层数，和childcomment无关

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


	}

	/**
	 * post the Update Edit
	 * PUT /comment/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
				
        function nl2p($text) {

    return "<p>" . str_replace("\n", "</p><p>", $text) . "</p>";

  }
$post = Post::findOrFail($id);

  $rules = [
        'content' => 'required',
   		//'tags'    => array('required', 'regex:/^\w+$|^(\w+,)+\w+$/'),
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->passes()) {
 
     $comment = Comment::with('content')->find($id);
     $comment->content = nl2p(Input::get('content'));


$comment->is18 =  (Input::has('is18'))? 1 : 0;  // 1:meat  点了说明次节有肉，没点说明没肉

  

	if (Input::has('isEnd')){//0:end, 1: continue  如果点了，说明文章完结。和comment没关系
    $post->isEnd =  0;
    $post->save();

      }

 $comment->update(Input::only('content','is18','isEnd'));


	}	
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


$comment = Comment::find($id);
        
if ($comment->parent_id != 0 ){   // this is a child comment
$parent = Comment::where("id", "=",  $comment->parent_id) -> first(); 
$post = Post:: where("id", "=",  $parent->post_id) -> first(); 
 $comment->delete();
return Redirect::route('post.show', $post->id);
}




if($comment->getNumChildrenStr() > 0 ) {  // this is a noemal comment which has children
	foreach ($comment->children() as $child) {
        
        $child->delete();
        
           
    }
    $post = Post:: where("id", "=",  $comment->post_id) -> first(); 
    $comment->delete();

 return Redirect::route('post.show', $post->id);

}

// a normal comment which dont has a child
else  {


    $post = Post:: where("id", "=",  $comment->post_id) -> first(); 
    $comment->delete();

 return Redirect::route('post.show', $post->id);



}


  
}







    //return Redirect::to('home');
 


}