<?php


class PostController extends BaseController {

  protected $layout = '_layouts.default';

  /**
   * Setup the layout used by the controller.
   *
   * @return void
   */


public function __construct()
{
    $this->beforeFilter('auth', array('only' => array('create', 'store', 'edit', 'update', 'destroy')));

    $this->beforeFilter('csrf', array('only' => array('store', 'update', 'destroy')));
    $this->beforeFilter('@canOperation', array('only' => array('edit', 'update', 'destroy')));

}

public function create()
{
    return View::make('articles.create');
}

/**
 * Retrieves a checkbox value from a form
 * 
 * @param  string $checkboxName The name of the checkbox
 * @param  string $defaultValue The checkbox default value, if there is none set
 * @return string
 */
function checkbox_value($checkboxName, $defaultValue)
{
  if (Input::has($checkboxName))
  {
    return Input::get($checkboxName);
  }
  
  return $defaultValue;
}

/**
 * Determines if a checkbox was checked in a form
 * 
 * @param  string $checkboxName The name of the checkbox
 * @return bool                 Returns TRUE if checked, FALSE otherwise
 */
function checkbox_checked($checkboxName)
{
  if (Input::has($checkboxName))
  {
    return true;
  }

  return false;
}



   // create a update for a given post
  public function createUpdate($id)
  {
    // get the post that the user commented on
    $post = Post::findOrFail($id);

    // create a new comment
    $update = new Update();
    //$update->is18 = Input::get('name');


  if (Input::has('isEnd')){   //0:end 
    $post->isEnd =  0;
    $post->save();

      }

    $update->is18 =  (Input::has('is18'))? 1 : 0;  // 1:meat

 $update->content = nl2br(Input::get('content'));

    // save the comment with a relation to the post
    $post->updates()->save($update);

    // go back to the post
    //return Redirect::route('viewPost', array('id' => $post->id));
     return Redirect::route('post.show', $post->id);
  }





public function canOperation($route, $request)
{
    if (!(Auth::user()->is_admin or Auth::id() == Post::find(Route::input('post'))->user_id))
    {


        return Redirect::to('/');
    }
}





public function onlyU($id)
{
    $post = Post::with('circle','tags', 'cps', 'charakters')->find($id);
    $updates = Comment::where('post_id', '=', $post->id)
                      ->where('isUpdate','=', '1')  
                        ->orderBy('created_at')->paginate(20);  

if (Auth::check()){                    
 $user = Auth::user();
  $user_post= $user->faverate_posts()->where('post_id','=', $id)->first(); //the post with uders like

if($user_post!=null)
{    // if already liked
  $alreadyLike = true;     

}else {
  $alreadyLike = false;
 
}     

    $this->layout->content = View::make('articles.onlyU', array(
      'post' => $post,
      'comments' => $updates,
      'alreadyLike'   => $alreadyLike    
    ));
  } else {
 $this->layout->content = View::make('articles.onlyU', array(
      'post' => $post,
      'comments' => $updates,
      'alreadyLike'   => false    
       ));


  }


}





public function top($id){

  $post = Post::find($id);


 $post->top = ( $post->top  == 1)  ?   0:   1;
 $post->update();

$result = Array("response" =>  $post->top);



// $result = Array("response" => 1);
 return Response::json($result);
//return View::make('articles.show')->with('post', $post);
}



public function block($id){

  $post = Post::find($id);


 $post->block = ( $post->block  == 1)  ?   0:   1;

$post->update();
$result = Array("response" =>  $post->block);



// $result = Array("response" => 1);
 return Response::json($result);
//return View::make('articles.show')->with('post', $post);
}


public function edit($id)
{
    $post = Post::with('circle','tags', 'cps', 'charakters')->find($id);
    $tags = '';
    $cps = '';
    $charakters = '';
    $circle =  $post->circle->name ;



    for ($i = 0, $len = count($post->tags); $i < $len; $i++) {
        $tags .= $post->tags[$i]->name . ($i == $len - 1 ? '' : ',');
    }
     for ($i = 0, $len = count($post->cps); $i < $len; $i++) {
        $cps .= $post->cps[$i]->name . ($i == $len - 1 ? '' : ',');
    }
     for ($i = 0, $len = count($post->charakters); $i < $len; $i++) {
        $charakters .= $post->charakters[$i]->name . ($i == $len - 1 ? '' : ',');
    }

    $post->tags = $tags;
    $post->cps = $cps;
    $post->charakters = $charakters;
    $post->circle = $circle;
    
    return View::make('articles.edit')->with('post', $post);
}



public function update($id)
{


function nl2p($text) {

    return "<p>" . str_replace("\n", "</p><p>", $text) . "</p>";

  }


    $rules = [
        'title'   => 'required|max:20',
        'content' => 'required',
        'name' => 'required|max:10',
        'summary' => 'required|max:70',
        'circle' => 'required|max:20',
        'charakters' => 'max:40',
        'cps' => 'max:20',
        'tags' => 'max:20',
        //'tags'    => array('required', 'regex:/^\w+$|^(\w+,)+\w+$/'),
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->passes()) {
       

        $post = Post::with('tags')->find($id);
        $post->update(Input::only('name','title', 'content','is18','summary','isEnd'));


      if (Input::has('is18'))
        {
         $post->is18 =  1;
        }else{

         $post->is18 =  0;
          }

    $post->isEnd =  Input::get('isEnd');
    $post->summary =  Input::get('summary');
    $post->name =  Input::get('name');
     $post->content =   Input::get('content');
  

   // $resolved_content = nl2br(Markdown::parse(  Input::get('content')));
    $resolved_content = nl2p(Input::get('content'));


       
    $post->resolved_content = $resolved_content;


//$cps2= Input::get('cps');
//echo $cps2;

$tags_re= preg_replace("/(\n)|(\s)|(\t)|(\')|(')|(，)|(\.)/",',',Input::get('tags'));
$cps_re= preg_replace("/(\n)|(\s)|(\t)|(\')|(')|(，)|(\.)/",',',Input::get('cps'));
$charakters_re=preg_replace("/(\n)|(\s)|(\t)|(\')|(')|(，)|(\.)/",',',Input::get('charakters'));

  
$tags = array_unique(explode("," , $tags_re ));
$cps = array_unique(explode("," , $cps_re ));
$charakters = array_unique(explode("," , $charakters_re ));



  $circlename = Input::get('circle');
          //$circle_old = Circle::whereName($circlename); 


          $circle = Circle::whereName($circlename)->first();   // 新输入的圈子名
          $circle_old = $post->circle;  // 之前输入的圈子
          
          
        if (strcmp($circle, $circle_old) !== 0) {  //如果输入的和以前不一样先把以前那个删了
           $circle_old->count--;        
           $circle_old->save();

           if($circle_old->count ==0 )
                $circle_old->delete();




              if (!$circle) {  // 如果数据库里面没有这个新输入的圈子
           
            $circle = Circle::create(array('name' => $circlename));  //crate p new circle with new npme
            $circle->count++;

            

            
            
            }   else {   // 如果数据库里面有这个圈子
              $circle->count++;
   
            
            }

            



           }  

           $post->circle_id = $circle->id;
           $circle->posts()->save($post);
            $circle->save();

   
        foreach ($post->tags as $tag) {
            if (($index = array_search($tag->name, $tags)) !== false) {
                unset($tags[$index]);
            } else {
                $tag->count--;
                $tag->save();
                 $post->tags()->detach($tag->id);

                   if($tag->count ==0 )
                        $tag->delete();
                // $tag->posts()->detach($post->id);
                //$tag->save();
            }
        }
        foreach ($tags as $tagName) {
            $tag = Tag::whereName($tagName)->first();  //get the first recoard of Tag
            if (!$tag) {
                $tag = Tag::create(array('name' => $tagName));
            }
            $tag->count++;
            $post->tags()->save($tag);
             //$tag->posts()->save($post);
             //$tag->save();
        }




      foreach ($post->cps as $cp) {
         $cp->circle_id= $circle->id;
         $cp->update();
            if (($index = array_search($cp->name, $cps)) !== false) {
                unset($cps[$index]);

          } else {
                $cp->count--;
                $post->cps()->detach($cp->id);
               
                //$cp->posts()->detach($post->id);
                $cp->save();
                if($cp->count ==0 )
                        $cp->delete();
            }
        }
        foreach ($cps as $cpName) {
            $cp = Cp::whereName($cpName)->first();
            if (!$cp) {
                $cp = Cp::create(array('name' => $cpName));
            }
            
            $cp->count++;

            $cp->circle_id = $circle->id;
            $post->cps()->save($cp);
             //$cp->posts()->save($post);
             $cp->save();
        }



          foreach ($post->charakters as $charakter) {
             $charakter->circle_id= $circle->id;
             $charakter->update();
            if (($index = array_search($charakter->name, $charakters)) !== false) {

                unset($charakters[$index]);

            } else {
                $charakter->count--;
                $post->charakters()->detach($charakter->id);
               


                //$charakter->posts()->detach($post->id);
                $charakter->save();
                if($charakter->count ==0 )
                        $charakter->delete();
                //var_dump(  $charakter->name);
          





            }
        }
        foreach ($charakters as $charakterName) {
            $charakter = Charakter::whereName($charakterName)->first();   //数据库已经有这个角色
            if (!$charakter) {
                $charakter = Charakter::create(array('name' => $charakterName)); //新出现的角色
               // var_dump(  $charakter->name);
            }
            $charakter->count++;
            $charakter->circle_id = $circle->id;
            $post->charakters()->save($charakter);
           // $charakter->posts()->save($post);
            $charakter->save();
        }

        
        //TODO: edit, if the circlename doenst change, dont count!

    
        $post->save();
        return Redirect::route('post.show', $post->id);


    } else {
        return Redirect::route('post.edit', $id)->withInput()->withErrors($validator);
    }
}



 public function store()
{
function nl2p($text) {

    return "<p>" . str_replace("\n", "</p><p>", $text) . "</p>";

  }

    $rules = [
        'title'   => 'required|max:20',
        'content' => 'required',
        'name' => 'required|max:10',
        'summary' => 'required|max:70',
        'circle' => 'required|max:20',
        'charakters' => 'max:40',
        'cps' => 'max:20',
        'tags' => 'max:20',

        //''    => array('required', 'regex:/^\w+$|^(\w+,)+\w+$/'),
    ];
      $validator = Validator::make(Input::all(), $rules);
    if ($validator->passes()) {
        $post = Post::create(Input::only('name','title', 'content','is18','summary','isEnd'));

//$myValue = checkbox_value('is18', '0');

    if (Input::has('is18'))
        {
         $post->is18 =  1;
        }else{

         $post->is18 =  0;
          }



//$post->is18 = checkbox_checked('is18');

       // $post->is18 =  Input::get('is18');
    $post->isEnd =  Input::get('isEnd');
   $post->summary =  Input::get('summary');
  
   $post->content =  Input::get('content');


   $post->user_id = Auth::id();

   //$resolved_content = nl2br( Markdown::parse(Input::get('content')));
   $resolved_content = nl2p(Input::get('content'));
   $post->resolved_content = $resolved_content;


if( Auth::user()->is_admin){
 $post->is_admin = 1;
  

}
 

  $post->name =  Input::get('name');

$tags_re= preg_replace("/(\n)|(\s)|(\t)|(\')|(')|(，)|(\.)/",',',Input::get('tags'));
$cps_re= preg_replace("/(\n)|(\s)|(\t)|(\')|(')|(，)|(\.)/",',',Input::get('cps'));
$charakters_re=preg_replace("/(\n)|(\s)|(\t)|(\')|(')|(，)|(\.)/",',',Input::get('charakters'));

$tags = explode("," , $tags_re );
$cps = explode("," , $cps_re );
$charakters = explode("," , $charakters_re );




      $circlename = Input::get('circle');
       $circle = Circle::whereName($circlename)->first();
           if (!$circle) {
                $circle = Circle::create(array('name' => $circlename));
            }

            $circle->count++;

       
        foreach ($tags as $tagName) {
            $tag = Tag::whereName($tagName)->first();
            if (!$tag) {
                $tag = Tag::create(array('name' => $tagName));
            }
            $tag->count++;


            $post->tags()->save($tag);
           // $tag->posts()->save($post);
        }

         foreach ($cps as $cpName) {
            $cp = Cp::whereName($cpName)->first();
            if (!$cp) {
            $cp = Cp::create(array('name' => $cpName));  //如果这个Cp在数据库没找到
            }
            $cp->count++;
            
            $cp->circle_id = $circle->id;
            //$cp->posts()->attach($post);
            $post->cps()->save($cp);   
            // var_dump($cp->name);   



        }
       


         foreach ($charakters as $charakterName) {
            $charakter = Charakter::whereName($charakterName)->first();
            if (!$charakter) {//如果这个角色在数据库没找到
                $charakter = Charakter::create(array('name' => $charakterName));


            }
            $charakter->count++;
            $charakter->circle_id = $circle->id;
            $post->charakters()->save($charakter);
            //$charakter->posts()->save($post);

        }
       // return Redirect::route('show_source()', $article->id);


         
          

            $post->circle_id = $circle->id;
           
            $circle->save();

            $post->save();


          // save the comment with a relation to the post
    

     return Redirect::route('post.show', $post->id);
     // return Redirect::route('post.show', $post->id);
        
    } else {
        //return Redirect::route('article.create')->withInput()->withErrors($validator);
  //return Redirect::route('createPost')->withInput()->withErrors($validator);
      return Redirect::route('post.create')->withInput()->withErrors($validator);


    }
}


public function destroy($id)
{


$post = Post::find($id);
      $circle = $post->circle;
        $circle->count--;
        $circle->save();
        if($circle->count == 0) 
           $circle->delete();


    foreach ($post->tags as $tag) {
        $tag->count--;
        $tag->save();
        $post->tags()->detach($tag->id);
        if($tag->count == 0) 
           $tag->delete();


    }

   foreach ($post->cps as $cp) {
        $cp->count--;
        $cp->save();
        $post->cps()->detach($cp->id);
        if($cp->count == 0) 
           $cp->delete();
    }

       foreach ($post->charakters as $charakter) {
        $charakter->count--;
        $charakter->save();
        $post->charakters()->detach($charakter->id);
         if($charakter->count == 0) 
           $charakter->delete();
    }

    foreach ($post->comments as $comment) { 
         foreach ($comment->children as $child) { 

     //destroy($comment->id);    
        $child->delete();

 }
        $comment->delete();
       
    }



    $post->delete();
    //return Redirect::to('home');
  return  Redirect::route('home');
}


public function show($id)     // see the detailed post
{
    //return View::make('articles.show')->with('article', Article::find($id));

  
  
    // get the post
    $post = Post::findOrFail($id);
    $comments =  $post ->comments() 
                       ->orderBy('created_at')
                       ->paginate(50);
if(!Auth::check()){
   $this->layout->content = View::make('articles.show', array(
      'post' => $post,
      'comments' => $comments,
      'alreadyLike' => false
    ));
}else {

     $user = Auth::user();
  $user_post= $user->faverate_posts()->where('post_id','=', $id)->first(); //the post with uders like

if($user_post!=null)
{    // if already liked
//var_dump("already liked!");
  $alreadyLike = true;     
 //$result = Array("response" => false);
 // $result['response'] = false;    // cancel the faverate
}else {
//var_dump("liked u!");
  $alreadyLike = false;
//$result = Array("response" => true);       // like the post
 
}                   


    $this->layout->content = View::make('articles.show', array(
      'post' => $post,
      'comments' => $comments,
      'alreadyLike' => $alreadyLike
    ));
}  
    //return View::make('articles.show')->with('article', Article::find($id));
}
  
  







}
