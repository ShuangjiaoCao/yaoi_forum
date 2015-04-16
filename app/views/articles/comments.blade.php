
<section id="comments">
<article class="am-comment">
  

@if (count($post->comments) != 0)

     <article id="comment_article" class="am-comment am-comment-primary">

       <ul class="am-comments-list" id="commentlist">

        @foreach ($comments as $comment)

        


        @if ($comment->isUpdate != 1) 
        
        
        <div id="autorbox" class="form-inline" >
        <div class="am-u-sm-2 am-u-md-1 am-u-lg-1" id="article-autor">
            <div id="autor1">{{ $comment->index}}# </div>
        </div>  



<div class="am-u-sm-6 am-u-md-6 am-u-lg-6" id="article-item1"> 

@if ($comment->is_admin==1)
 <div id="autor2"  class="am-show-md-up" > <b> <font color="green">{{ $comment->name }}</font> </b> 回复于:{{ $comment->created_at->timezone('Asia/Shanghai')}}</div>

   <div id="autor2"  class="am-show-sm-only" > <b> <font color="green">{{ $comment->name }}</font> </b></div>

   
        @else 
     <div id="autor2"  class="am-show-md-up" ><b>{{$comment->name }}</b> 回复于:{{ $comment->created_at->timezone('Asia/Shanghai')}}</div>

   <div id="autor2"  class="am-show-sm-only" ><b>{{$comment->name }}</b>  </div>
       

          @endif 

<div  class="am-show-sm-only" > 
 @if (Auth::check() && Auth::user()->is_admin)      

      {{Form::open(array('action' => array('CommentController@destroy', $comment->id), 'method' => 'DELETE' ,'style' => 'display: inline'))}}
                  <button  type="button" class="am-btn am-btn-xs am-btn-hallo" type='submit'value="delete" id="delete{{$post->id}}" ><span class="am-icon-remove"></span></button>
              {{ Form::close() }}

            @endif

 </div>




  

 </div> 



         <div class="am-u-sm-4 am-u-md-5 am-u-lg-5" id="article-item2">  



        
<button  class="am-btn am-btn-default am-btn-xs" id="childCommentButton"  value="{{$comment->id}}"  data-toggle="collapse" >
<div  class="form-inline">
<i id="arrowicon" class="glyphicon glyphicon-arrow-down"></i>
<span id="huifu">回复此楼</span> 
<span class="badge">{{$comment->getNumChildrenStr()}}</span>
</div> 
</button>
 

<div  class="am-show-md-up" > 
 

  @if (Auth::check())  

      @if ($post->user_id == Auth::id()|| Auth::user()->is_admin)

 {{Form::open(array('action' => array('CommentController@destroy', $comment->id), 'method' => 'DELETE' ,'style' => 'display: inline'))}}
                  <button  type="button" class="am-btn am-btn-xs hallo" type='submit'value="delete" id="delete{{$comment->id}}" ><span class="am-icon-remove"></span></button>
              {{ Form::close() }}

      @endif
    @endif 

          
       
         </div>



   


       
         </div>
          </div> 
           
      




     

     
        <li class="am-comment">
    <div id="commentContent">

{{ $comment->content }}
  @include('articles.childcomments')

</div>
        
         </li>  
      

         @else     

 
        <div id="autorbox" class="form-inline" >
       <div class="am-u-sm-2 am-u-md-1 am-u-lg-1" id="article-autor">
            <div id="autor1">{{$comment->index}}# </div>
        </div>  



          
          <div class="am-u-sm-5 am-u-md-6 am-u-lg-6" id="article-item1"> 
        @if ($comment->is_admin==1)
 <div id="autor2"  class="am-show-md-up" > <b> <font color="green">{{ $post->name }}</font> </b> 更新于:{{ $comment->created_at->timezone('Asia/Shanghai')}} <span class="label label-danger">{{ ($comment->is18 == 1) ? '此章有肉' : ''  }}</span></div>

   <div id="autor2"  class="am-show-sm-only" > <b> <font color="green">{{ $post->name }}</font> </b></div>

   
        @else 
     <div id="autor2"  class="am-show-md-up" ><b>{{$post->name }}</b> 更新于:{{ $comment->created_at->timezone('Asia/Shanghai')}} <span class="label label-danger">{{ ($comment->is18 == 1) ? '此章有肉' : ''  }}</span> </div>

   <div id="autor2"  class="am-show-sm-only" ><b>{{$post->name }}</b>  </div>
       

          @endif 

<div  class="am-show-sm-only" > 
 @if (Auth::check() && Auth::user()->is_admin)      

      {{Form::open(array('action' => array('CommentController@destroy', $comment->id), 'method' => 'DELETE' ,'style' => 'display: inline'))}}
                  <button  type="button" class="am-btn am-btn-xs am-btn-hallo" type='submit'value="delete" id="delete{{$post->id}}" ><span class="am-icon-remove"></span></button>
              {{ Form::close() }}

            @endif

 </div>



 </div>  




         <div class="am-u-sm-5 am-u-md-5 am-u-lg-5" id="article-item2">   

<button  class="am-btn am-btn-default am-btn-xs" id="childCommentButton"  value="{{$comment->id}}"  data-toggle="collapse" >
<div  class="form-inline">
<i id="arrowicon" class="glyphicon glyphicon-arrow-down"></i>
<span id="huifu">回复此楼</span> 
<span class="badge">{{$comment->getNumChildrenStr()}}</span>
</div> 
</button>




<div  class="am-show-md-up" > 
 

  @if (Auth::check())  

      @if ($post->user_id == Auth::id()|| Auth::user()->is_admin)

 {{Form::open(array('action' => array('CommentController@destroy', $comment->id), 'method' => 'DELETE' ,'style' => 'display: inline'))}}
                  <button  type="button" class="am-btn am-btn-xs hallo" type='submit'value="delete" id="delete{{$comment->id}}" ><span class="am-icon-remove"></span></button>
              {{ Form::close() }}

      @endif
    @endif 

          
       
         </div>
          </div> 
           

 </div>


     
    

      <li class="am-comment">
        <div id="updateContent">
   
            @if($comment->is18 ==1  &&  !Auth::check()  ) 
         <div style="color:red"> 我是一块红烧肉  </div>
      @else
      <p>{{ $comment->content }}</p>

      @endif       

      @include('articles.childcomments')
         </div>
         </li>  
      
        @endif


     
       
     
        @endforeach
            
    
        </ul>
 



    @endif

   </article>  



  </article>

</section>




  <p class="list-group-item-text">{{ $comments->links() }}</p>

  <section>
  


        <br/>



 @if ($post->user_id == Auth::id())
      @if ($post->block==0)
  <form id="antwort" action="{{ URL::route('createUpdate', array('id' => $post->id)) }}" method="post">
      
    <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->


      <div class="form-group">
        <textarea name="content" class="form-control" rows="20" placeholder="更新内容"></textarea>
      </div>
      <div class="row form-inline"  >

  <div class="col-xs-2">
    <div class="form-group has-error " style="">
        <div class="checkbox">
        <label>
     <input  name="is18" type="checkbox" value="0">
      此章有肉
    </label>
  </div>
 </div>
 </div>
  <div class="col-xs-2">
  <div class="form-group">
        <div class="checkbox">
        <label>
     <input  name="isEnd" type="checkbox" value="0">
      勾我完结
    </label>
  </div>
 </div>
  </div>
   </div>
<div class="am-u-sm-3 am-u-sm-centered">
<button type="submit" class="btn btn-primary btn-lg"> 更新文章 </button>
   </div>
    </form>
 @else
   
     <div style="color:red"> 此贴已锁！</div> 

   @endif


 @else

       @if ($post->block==0)
    <form id="antwort" action="{{ URL::route('createComment', array('id' => $post->id)) }}" method="post">

      <div class="form-group">
      <input name="name" class="form-control" type="text" value="{{ Input::old('name')}}"  placeholder="昵称" />   
       </div>
     

      <div class="form-group">
        <textarea name="content" class="form-control" rows="5" placeholder="评论内容"></textarea>
      </div>
      <div class="am-u-sm-3 am-u-sm-centered">
      <button type="submit" class="btn btn-primary btn-lg"> 回复 </button>
       </div>
    </form>
   @else
   
     <div style="color:red"> 此贴已锁！</div> 
     @endif

     

  @endif

   
  </section>