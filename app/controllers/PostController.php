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


  if (Input::has('isEnd')){//0:end 
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
    $updates = Comment::where('name','=', $post->name)
                    ->orderBy('created_at')->paginate(20);
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
    $rules = [
        'title'   => 'required|max:100',
        'content' => 'required',
        'name' => 'required',
        'summary' => 'required',
        'circle' => 'required',
        'charakters' => 'required',
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
  






        $resolved_content = Markdown::parse(Input::get('content'));
        $post->resolved_content = $resolved_content;


//$cps2= Input::get('cps');
//echo $cps2;

$tags_re= preg_replace("/(\n)|(\s)|(\t)|(\')|(')|(，)|(\.)/",',',Input::get('tags'));
$cps_re= preg_replace("/(\n)|(\s)|(\t)|(\')|(')|(，)|(\.)/",',',Input::get('cps'));
$charakters_re=preg_replace("/(\n)|(\s)|(\t)|(\')|(')|(，)|(\.)/",',',Input::get('charakters'));

  // 黑花，你是谁。  全部的string
$tags = array_unique(explode("," , $tags_re ));
$cps = array_unique(explode("," , $cps_re ));
$charakters = array_unique(explode("," , $charakters_re ));



  $circlename = Input::get('circle');
          //$circle_old = Circle::whereName($circlename); 


          $circle = Circle::whereName($circlename)->first();   // 新输入的圈子名，比如银魂
          $circle_old = $post->circle;  // 之前输入的圈子，比如猎人
          //$circle->count--;
          
        if (strcmp($circle, $circle_old) !== 0) {  //如果输入的和以前不一样
          $circle_old->count--;
         
          $circle_old->posts()->detach($post->id);
           $circle_old->save();

          
          //echo '输入的和以前不一样';


              if (!$circle) {  // 如果数据库里面没有银魂
           
            $circle = Circle::create(array('name' => $circlename));  //crate p new circle with new npme
            $circle->count++;

             //echo '输入的是新圈子';
            
            }   else {   // 如果数据库里面有银魂
              $circle->count++;
   
            //echo '输入的是数据库里面已经有的圈子';
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
            if (($index = array_search($cp->name, $cps)) !== false) {
                unset($cps[$index]);
            } else {
                $cp->count--;
                $post->cps()->detach($cp->id);
                //$cp->posts()->detach($post->id);
                //$cp->save();
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
             //$cp->save();
        }



          foreach ($post->charakters as $charakter) {
            if (($index = array_search($charakter->name, $charakters)) !== false) {
                unset($charakters[$index]);
            } else {
                $charakter->count--;
                $post->charakters()->detach($charakter->id);
                //$charakter->posts()->detach($post->id);
                //$charakter->save();

            }
        }
        foreach ($charakters as $charakterName) {
            $charakter = Charakter::whereName($charakterName)->first();   //数据库已经有这个角色
            if (!$charakter) {
                $charakter = Charakter::create(array('name' => $charakterName)); //新出现的角色
            }
            $charakter->count++;
            $charakter->circle_id = $circle->id;
            $post->charakters()->save($charakter);
           // $charakter->posts()->save($post);
            //$charakter->save();
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


    $rules = [
        'title'   => 'required|max:100',
        'content' => 'required',
        'name' => 'required',
        'summary' => 'required',
        'circle' => 'required',
        'charakters' => 'required',

        //''    => array('required', 'regex:/^\w+$|^(\w+,)+\w+$/'),
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->passes()) {
        $post = POST::create(Input::only( 'name','title', 'content','is18','summary','isEnd'));

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
   $post->name =  Input::get('name');



   
   //$circle = Circle::create(array('name' => Input::get('circle')));
   //$post->circle_id = $circle->id;

   //$post->circlename =   Input::get('circle');

   //$post->circle->name =  Input::get('circle');

  // $post->circle_id =  Input::get('circle_id');
   $post->user_id = Auth::id();
   $resolved_content = Markdown::parse(Input::get('content'));
   $post->resolved_content = $resolved_content;


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
        //$post->circle->detach($tag->id);


    foreach ($post->tags as $tag) {
        $tag->count--;
        $tag->save();
        $post->tags()->detach($tag->id);
    }

   foreach ($post->cps as $cp) {
        $cp->count--;
        $cp->save();
        $post->cps()->detach($cp->id);
    }

       foreach ($post->charakters as $charakter) {
        $charakter->count--;
        $charakter->save();
        $post->charakters()->detach($charakter->id);
    }

    foreach ($post->comments as $comment) {
        
        $comment->delete();
        //$post->comments()->detach($comment->id);
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
                       ->paginate(20);
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
