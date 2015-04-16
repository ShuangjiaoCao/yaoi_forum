@extends('_layouts.default')

@section('content')



  <div class="am-g am-g-fixed" id="fixPost">
      <div  class="am-u-sm-12">
        <br/>
     
      <article  class="am-article" value="{{$post->id}} " >
        <div id="article_title" class="am-article-hd">
          <h1 class="am-article-title">  
           
           {{{ ($post->isEnd == 0) ? '[完结]' : '[连载]'}}}   {{{ $post->title }}}</h1>

        </div>
        <div class="am-article-bd" >
   


<div class="am-g">
  <div id="summaryField" >
<div  class="am-g">
     <div class="am-u-sm-12">
          <div id="summarytext">{{ $post->summary }}</div>

      </div>
</div>



         <div  class="am-g">
    <div id= "tagsvor" class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            
              
              圈子:
              <a href="{{ URL::to('circle/' . $post->circle_id . '/posts') }}" id="circlename_show" class="am-badge am-badge-warning am-radius"> {{{$post->circle->name}}}</a>


              CP:
              @foreach ($post->cps as $cp)
                  <a  href="{{ URL::to('cp/' .  $cp->id . '/posts') }}" id="cpname_show" class="am-badge am-badge-warning am-radius">{{ $cp->name }}</a>
              @endforeach



            角色:
            @foreach ($post->charakters as $charakter)
                  <a  href="{{ URL::to('charakter/' .  $charakter->id . '/posts') }}" id="peoplename_show" class="am-badge am-badge am-radius">{{ $charakter->name }}</a>
              @endforeach

            TAGS:
              @foreach ($post->tags as $tag)
                  <a href="{{ URL::to('tag/' . $tag->id . '/posts') }}" id="tagsname_show" class="am-badge am-badge am-radius">{{ $tag->name }}</a>
              @endforeach
     
  </div>
 </div>

    </div>

</div>





<div id="autorbox" class="am-g  form-inline" >

<div class="am-u-sm-2 am-u-md-1 am-u-lg-1" id="article-autor">
      <div id="autor1">作者</div>
</div>   

<div class="am-u-sm-7 am-u-md-5 am-u-lg-5" id="article-item1"> 


<div class="am-show-md-up form-inline" id="autor2">
 @if ($post->is_admin==1)
    <b> <font color="green">{{ $post->name }}</font> </b>
        @else 
     <b>{{ $post->name }} </b>

          @endif 


<font size="1,5px"> 发表于:{{ $post->created_at->timezone('Asia/Shanghai') }} </font> <span class="label label-danger">{{ ($post->is18 == 1) ? '有肉' : ''  }}</span></div>

<div class="am-show-sm-only" id="autor2"><b>{{{$post->name }}}</b>  <span class="label label-danger">{{ ($post->is18 == 1) ? '有肉' : ''  }}</span></div>




</div> 

<div class="am-u-sm-3 am-u-md-6 am-u-lg-6" id="article-item2">    
      
<div class="am-show-sm-only">
<nav id="phonemenunav" data-am-widget="menu" class="am-menu am-menu-dropdown1" data-am-menu-collapse>
  <a href="javascript: void(0)" class="am-menu-toggle">
    <span id="phonemenu" class="am-menu-toggle-title">戳我</span>
    <i class="am-menu-toggle-icon am-icon-angle-right"></i>
  </a>
  <ul class="am-menu-nav am-avg-sm-1 am-collapse">
    <li class="am-parent">
      
    </li>
   
      
       @if (Auth::check() && Auth::user()->is_admin)
        <li class="">    
       <a href="##" class="">
        <form  role="form" name="blockpost" action="" id="blockform">  
         @if( $post->block==0) 

        <button id="blockpost" value="{{$post->id}}"  class="am-btn am-btn am-btn-defaut">锁</button>
        @else
        <button id="blockpost" value="{{$post->id}}"  class="am-btn am-btn am-btn-defaut">解锁</button>
          @endif

         </form>
      
      </a>
    </li>
  @endif  



        @if (Auth::check() && Auth::user()->is_admin)  

    <li class="">
      <a href="##" class="">  
        <form  role="form" name="toppost" action="" id="topform"> 
          @if( $post->top==0) 
        <button id="toppost" value="{{$post->id}}"  class="am-btn am-btn-xs am-btn-defaut">置顶</button>
           @else
        <button id="toppost" value="{{$post->id}}"  class="am-btn am-btn-xs am-btn-defaut">取消置顶</button>
          @endif
         </form>
           </a>
    </li>
        @endif
   


    
      @if (Auth::check())
      <li class="">
      <a href="##" class="">
  <form  name="faverate" action="" id="faverateform">
    @if ($alreadyLike==true)  
      <button type="submit" value="{{$post->id}}" id="faverate" class="am-btn">取消收藏</button>
    @else 
      <button type="submit" value="{{$post->id}}" id="faverate" class="am-btn">收藏</button>
    @endif 

  </form>

      </a>
    </li>
@endif


    <li class="">
   
 <a id="onlypost" href="{{ URL::to('post/'. $post->id . '/allupdates') }}" class="">只看楼主</a>

    </li>


   

      @if (Auth::check()) 
   @if ($post->user_id == Auth::id()|| Auth::user()->is_admin)
    <li class="">

             <a id="editpost" href="{{ URL::to('post/'. $post->id . '/edit') }}" class="">编辑</a>
              </li>
    @endif
           @endif 

   


   
@if (Auth::check()) 
          @if ($post->user_id == Auth::id()|| Auth::user()->is_admin)
<li class="">
     <a href="##" class="">
  {{Form::open(array('action' => array('PostController@destroy', $post->id), 'method' => 'DELETE' ,'style' => 'display: inline'))}}
                  <button  class="am-btn am-btn-xs" type="submit" value="delete" id="delete{{$post->id}}" >删除</button>
              {{ Form::close() }}
                    </a>
    </li>
           
          @endif
           @endif 
     
  </ul>
</nav>

</div> 


 <div class="am-show-md-up">

      

        @if (Auth::check() && Auth::user()->is_admin)    
        <form  role="form" name="blockpost" action="" id="blockform">  
         @if( $post->block==0) 
        <button id="blockpost" value="{{$post->id}}"  class="am-btn am-btn-xs am-btn-defaut">锁</button>
        @else
        <button id="blockpost" value="{{$post->id}}"  class="am-btn am-btn-xs am-btn-defaut">解锁</button>
          @endif
         </form>

         <form  role="form" name="toppost" action="" id="topform"> 
          @if( $post->top==0) 
        <button id="toppost" value="{{$post->id}}"  class="am-btn am-btn-xs am-btn-defaut">置顶</button>
           @else
        <button id="toppost" value="{{$post->id}}"  class="am-btn am-btn-xs am-btn-defaut">取消置顶</button>
          @endif
         </form>
        @endif




@if (Auth::check())
  <form  name="faverate" action="" id="faverateform">
    @if ($alreadyLike==true)  
      <button type="submit" value="{{$post->id}}" id="faverate" class="am-btn"><span id="faverate_full" class="glyphicon glyphicon-star"></span></button>
    @else 
      <button type="submit" value="{{$post->id}}" id="faverate" class="am-btn"><span id="faverate_empty" class="glyphicon glyphicon-star-empty"></span></button>
    @endif 
    </td>
  </form>
@endif



 <a id="onlypost" href="{{ URL::to('post/'. $post->id . '/allupdates') }}" class="am-btn am-btn-xs am-btn-primary"><span class="am-icon-eye"></span>只看楼主</a>


     
      @if (Auth::check()) 
          @if ($post->user_id == Auth::id()|| Auth::user()->is_admin)

             <a id="editpost" href="{{ URL::to('post/'. $post->id . '/edit') }}" class="am-btn am-btn-xs"><span class="am-icon-pencil"></span></a>
   
  {{Form::open(array('action' => array('PostController@destroy', $post->id), 'method' => 'DELETE' ,'style' => 'display: inline'))}}
                  <button  class="am-btn am-btn-xs" type="submit" value="delete" id="delete{{$post->id}}" ><span class="am-icon-remove"></span></button>
              {{ Form::close() }}
           
          @endif
           @endif 
  
             

</div> 
</div> 


    </div>
</div>


        <div  id="article_bd"  class="am-article-divider" >


          </p>

@if($post->is18 ==1  &&  !Auth::check()  ) 
 <div style="color:red"> 我是一块红烧肉  </div>
@else

 <div id="postcontent">{{ $post->resolved_content }}  </div>

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

@include('articles.comments')






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
        <button type="button" class="btn btn-primary"  id="sure">确定</button>
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


