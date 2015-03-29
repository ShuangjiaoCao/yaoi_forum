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






 public function store()
{
    $rules = [
        'title'   => 'required|max:100',
        'content' => 'required',
        'name' => 'required',
        'summary' => 'required',
        'tags'    => array('required', 'regex:/^\w+$|^(\w+,)+\w+$/'),
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->passes()) {
        $post = POST::create(Input::only('name','title', 'content','is18','summary','isEnd'));

//$myValue = checkbox_value('is18', '0');

    if (Input::has('is18'))
        {
         $post->is18 =  true;
        }else{

         $post->is18 =  false;
          }



 if (Input::has('isEnd'))
        {
         $post->isEnd =  true;
        }else{

         $post->isEnd =  false;
          }
//$post->is18 = checkbox_checked('is18');

       // $post->is18 =  Input::get('is18');
   
   $post->summary =  Input::get('summary');
   $post->name =  Input::get('name');
      

        $post->user_id = Auth::id();
        $resolved_content = Markdown::parse(Input::get('content'));
        $post->resolved_content = $resolved_content;
        $tags = explode(',', Input::get('tags'));
        if (str_contains($resolved_content, '<p>')) {
            $start = strpos($resolved_content, '<p>');
            $length = strpos($resolved_content, '</p>') - $start - 3;
            //$post->summary = substr($resolved_content, $start + 3, $length);
        } else if (str_contains($resolved_content, '</h')) {
            $start = strpos($resolved_content, '<h');
            $length = strpos($resolved_content, '</h') - $start - 4;
            //$post->summary = substr($resolved_content, $start + 4, $length);
        }
        $post->save();
        foreach ($tags as $tagName) {
            $tag = Tag::whereName($tagName)->first();
            if (!$tag) {
                $tag = Tag::create(array('name' => $tagName));
            }
            $tag->count++;
            $post->tags()->save($tag);
        }
       // return Redirect::route('show_source()', $article->id);

     return Redirect::route('post.show', $post->id);
     // return Redirect::route('post.show', $post->id);
        
    } else {
        //return Redirect::route('article.create')->withInput()->withErrors($validator);
  //return Redirect::route('createPost')->withInput()->withErrors($validator);
      return Redirect::route('post.create')->withInput()->withErrors($validator);


    }
}

public function show($id)
{
    //return View::make('articles.show')->with('article', Article::find($id));

  
  
    // get the post
    $post = Post::findOrFail($id);

    $this->layout->content = View::make('articles.show', array(
      'post' => $post
    ));

    //return View::make('articles.show')->with('article', Article::find($id));
}
  
  







}
