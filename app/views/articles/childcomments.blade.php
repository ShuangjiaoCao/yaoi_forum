

<div class="collapse" id="nestedComment{{$comment->id}}">

   <div class="actionBox">

      <div class="am-list-news-bd">
        <ul class="am-list" id="commentList{{$comment->id}}">
       
        @if($comment->children->count() > 0)
              @foreach($comment->children as $child)

           
               <li class="am-g"  id="childlist">
                <div class="commentText">
                     {{ $child->content }}</div>


          <div id="child-comment-meta"  style="display:inline">
            <a href="#link-to-user" class="am-comment-author">{{ $child->name }} </a>
              评论于 {{$child->updated_at->timezone('Asia/Shanghai')}}

                    @if (Auth::check() &&  Auth::user()->is_admin)

              {{Form::open(array('action' => array('CommentController@destroy', $child->id), 'method' => 'DELETE' ,'style' => 'display: inline'))}}
                  <button  type="button" class="am-btn am-btn-hallo2 am-btn-xs" type='submit'value="delete" id="delete{{$child->id}}" ><span class="am-icon-remove"></span> </button>
              {{ Form::close() }}

                    @endif




           </div>
                        
                 
               </li> 
            @endforeach



            @endif
                    
          
        </ul>
    </div>

 @if ($errors->has())
    <div class="am-alert am-alert-danger" data-am-alert>
      <p>{{ $errors->first() }}</p>
    </div>
    @endif

    
<div class="am-g form-inline">
        @if ($post->block==0)

        <form role="form" id="postchildcomment{{$comment->id}}" method="POST" name="postchild">
           
          
            <fieldset>

              <div class="col-sm-2">
        
             <input id= "nestcommentName{{$comment->id}}" class="form-control" type="text" placeholder="输入昵称" />
              </div>  

              

            <div class="col-sm-8">
            <div id="nestcommentinputdiv" class="form-group">
             <input id= "nestcommentinput{{$comment->id}}" style="width: 90%;" class="form-control" type="text" placeholder="输入评论内容" />    
              </div>  </div>  

             

                 <div class="col-sm-1">
           
            
                <button type="submit" id="nestcommentSend{{$comment->id}}"  style="float:right;" value="{{$comment->id}}" class="btn btn-default">回复</button>

            </div>

            
             </fieldset> 
             

            


           
        </form>

        @endif
</div>


    </div>
</div>
      