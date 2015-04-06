@extends('_layouts.default')

@section('content')





  <div class="am-g am-g-fixed">
      <div  class="am-u-sm-12">
        <br/>

        
      <article  class="am-article" value="{{$post->id}} " >
        <div id="article_title" class="am-article-hd">
          <h1 class="am-article-title">  
           <a href="{{ URL::to('circle/' . $post->circle_id . '/posts') }}" id="circlename_show" class="am-badge am-badge-warning am-radius"> {{{$post->circle->name}}}</a>
              @foreach ($post->cps as $cp)
                  <a  href="{{ URL::to('cp/' .  $cp->id . '/posts') }}" id="cpname_show" class="am-badge am-badge-warning am-radius">{{ $cp->name }}</a>
              @endforeach
           {{{ ($post->isEnd == 0) ? '[完结]' : '[连载]'}}}   {{{ $post->title }}}</h1>
       <p class="am-article-meta">作者: <a style="cursor: pointer;">{{{ $post->name }}}</a> 发表时间{{ $post->updated_at }}</p>
        </div>
        <div class="am-article-bd" >

        <span class="label label-danger">{{ ($post->is18 == 1) ? '有肉' : ''  }}</span>
        </td>
          @if ($post->user_id == Auth::id())
            <td>
              <a id="editpost" href="{{ URL::to('post/'. $post->id . '/edit') }}" class="am-btn am-btn-xs am-btn-primary"><span class="am-icon-pencil"></span> 编辑</a>
        

  {{ Form::open(array('action' => array('PostController@destroy', $post->id), 'method' => 'DELETE' ,'style' => 'display: inline'))}}
                  <button  type="button" class="am-btn am-btn-xs am-btn-danger" type='submit'value="delete" id="delete{{$post->id}}" ><span class="am-icon-remove"></span> 删除</button>
              {{ Form::close() }}
            </td>
          @endif

            <td>
             
              <a id="onlypost" href="{{ URL::to('post/'. $post->id . '/allupdates') }}" class="am-btn am-btn-xs am-btn-primary"><span class="am-icon-eye"></span> 楼主 </a>
      @if (Auth::check())

<div id="faverate_form">
<form  name="faverate" action="">
<fieldset>

    @if ($alreadyLike==true)  
  <button type="submit" value="{{$post->id}}" id="faverate" class="am-btn am-btn-xs am-btn-danger am-active"><span class="am-icon-heart"></span></button>
    @else 
      <button type="submit" value="{{$post->id}}" id="faverate" class="am-btn am-btn-xs am-btn-danger"><span class="am-icon-heart"></span></button>
    @endif 


 </fieldset>
 </form>
 </div>
      @endif

        </tr> 
        <blockquote>
              相关人物:
              @foreach ($post->charakters as $charakter)
                  <a  href="{{ URL::to('charakter/' .  $charakter->id . '/posts') }}" class="am-badge am-badge am-radius">{{ $charakter->name }}</a>
              @endforeach
            </blockquote>  
           <blockquote>
              其他Tags:
              @foreach ($post->tags as $tag)
                  <a href="{{ URL::to('tag/' . $tag->id . '/posts') }}" class="am-badge am-badge am-radius">{{ $tag->name }}</a>
              @endforeach
            </blockquote>  

    <div class="am-article-lead">
          <p>{{ $post->summary }}</p>
    </div>
        <div  id="article_bd"  class="am-article-divider" >


          </p>

@if($post->is18 ==1  &&  !Auth::check()  ) 
 <div style="color:red"> 我是一块红烧肉  </div>
@else
 <p>{{ $post->resolved_content }}</p>
@endif       
        </div>
        <br/>


      </div>

</article>

 @if ($errors->has())
    <div class="am-alert am-alert-danger" data-am-alert>
      <p>{{ $errors->first() }}</p>
    </div>
    @endif


<section id="comments">
<article class="am-comment">
  

       
        
    @if (count($post->comments) != 0)

     <article id="comment_article" class="am-comment am-comment-primary">

       <ul class="am-comments-list" id="commentlist">

        @foreach ($comments as $comment)

        

         @if ($comment->isUpdate != 1) 
        <header class="am-comment-hd">
       <div class="am-comment-meta">
        <a href="#link-to-user" class="am-comment-author">{{ $comment->name }} </a>
        评论于 <time datetime="2013-07-27T04:54:29-07:00" title="2013年7月27日 下午7:54 格林尼治标准时间+0800">{{$comment->updated_at}}</time>
        <span class="commentCount"> {{ $comment->index}} 楼</span>
       </div>
       </header>


       <div class="am-comment-bd">

        <li class="am-comment">

        
         
            {{ $comment->content }}
         </li>  
       </div>

         @else  


         <header class="am-comment-hd">
       <div class="am-comment-meta" >
        <a href="#link-to-user" class="am-comment-author">{{ $post->name }} </a>
        更新于 <time datetime="2013-07-27T04:54:29-07:00" title="2013年7月27日 下午7:54 格林尼治标准时间+0800">{{ $comment->updated_at }}</time>
         <span class="label label-danger">{{ ($comment->is18 == 1) ? '此章有肉' : ''  }}</span>
          <span class="commentCount"> {{ $comment->index}} 楼</span>
       </div>
       
       </header>



       <div class="am-comment-bd">
      <li class="am-comment">

   
            @if($comment->is18 ==1  &&  !Auth::check()  ) 
         <div style="color:red"> 我是一块红烧肉  </div>
      @else
      <p>{{ $comment->content }}</p>
      @endif       

         </li>  
       </div>
        @endif
     
       
     
        @endforeach
            
    
        </ul>
 



    @endif

   </article>  



  </article>

</section>




  <section>
  


        <br/>


 @if ($post->user_id == Auth::id())
  <form action="{{ URL::route('createUpdate', array('id' => $post->id)) }}" method="post">
      
    <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->


      <div class="form-group">
        <textarea name="content" class="form-control" rows="20" placeholder="更新内容"></textarea>
      </div>
      <div class="row form-inline"  >


    <div class="form-group has-error " style="">
        <div class="checkbox">
        <label>
     <input  name="is18" type="checkbox" value="0">
      此章有肉
    </label>
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

<button type="submit" class="btn btn-primary btn-lg"> 更新文章 </button>
    </form>
 @else


    <form action="{{ URL::route('createComment', array('id' => $post->id)) }}" method="post">

      <div class="form-group">
      <input name="name" class="form-control" type="text" value="{{ Input::old('name')}}"  placeholder="昵称" />   
       </div>
     

      <div class="form-group">
        <textarea name="content" class="form-control" rows="5" placeholder="评论内容"></textarea>
      </div>
      <button type="submit" class="btn btn-primary btn-lg"> 回复 </button>
    </form>

     

  @endif

  <p class="list-group-item-text">{{ $comments->links() }}</p>
   
  </section>

<div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">删除文章</div>
    <div class="am-modal-bd">你确定要删除吗？
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
    </div>
  </div>
</div>

<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">删除文章</h4>
      </div>
      <div class="modal-body">
        <p> 你确定要删除吗？</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary"  id="delete">确定</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="faverate-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">收藏</h4>
      </div>
      <div class="modal-body">
        <p> 收藏成功！</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">哦</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="faverate-modal-cancle">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">收藏</h4>
      </div>
      <div class="modal-body">
        <p>取消收藏成功！</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">哦</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





@stop


