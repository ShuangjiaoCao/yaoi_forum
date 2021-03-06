@extends('_layouts.defaut')




<div class="am-g am-g-fixed blog-g-fixed">



 <div class="panel-body panel-list-group">
    <div class="list-group">
    @foreach ($posts as $post)


        <div class="list-group-item list-group-item-info">
         <span class="badge">{{$post->getNumCommentsStr()}}</span>

     <h4 class="list-group-item-heading"> 
       <a id="circlename" class="am-badge am-badge-warning am-radius"> {{{$post->circle->name}}}</a>
              @foreach ($post->cps as $cp)
                  <a  id="cpname" class="am-badge am-badge-warning am-radius">{{ $cp->name }}</a>
              @endforeach
           {{{ ($post->isEnd == 0) ? '[完结]' : '[连载]'}}}  

      <a href="{{ URL::route('post.show', $post->id) }}">
            {{{ $post->title }}}
        </a>

         <small>{{  $post->updated_at->diffForHumans() }}  by {{  $post->name }}  </small> 
    
      @foreach ($post->tags as $tag)
        <span href="#" style="color: #fff;" class="am-badge am-badge-success am-radius">{{ $tag->name }}</span>
            @endforeach

        </h4>


  <p class="list-group-item-text">{{$post->summary}}</p>


    </div>

        
      @endforeach

      <p class="list-group-item-text">{{ $posts->links() }}</p>

    </div>
  </div>


</div>




<div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
  <div class="am-modal-dialog">
    <div class="am-modal-bd">
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-cancel>No</span>
      <span class="am-modal-btn" data-am-modal-confirm>Yes</span>
    </div>
  </div>
</div>

@stop