@extends('_layouts.default')

@section('content')
<div class="am-g am-g-fixed">
  <div class="am-u-sm-12">
    <br/>

  
    <blockquote>Tag: <span class="am-badge am-badge-success am-radius">{{{ $tag->name }}}</span></blockquote>
  	   @foreach ($posts as $post)


        <div class="list-group-item list-group-item-info">
         <span class="badge">{{$post->getNumCommentsStr()}}</span>

     <h4 class="list-group-item-heading"> 
       <a id="circlename" href="{{ URL::to('circle/' . $post->circle_id . '/posts') }}" class="am-badge am-badge-warning am-radius"> {{{$post->circle->name}}}</a>
              @foreach ($post->cps as $cp)
                  <a  id="cpname" href="{{ URL::to('cp/' .  $cp->id . '/posts') }}" class="am-badge am-badge-warning am-radius">{{ $cp->name }}</a>
              @endforeach
      <a href="{{ URL::route('post.show', $post->id) }}">
       {{{ ($post->isEnd == 0) ? '[完结]' : '[连载]'}}}  
            {{{ $post->title }}}
        </a>

         <small>{{  $post->updated_at->diffForHumans() }}  by {{  $post->name }}  </small> 
    
      @foreach ($post->tags as $tag)
        <a href="{{ URL::to('tag/' . $tag->id . '/posts') }}" style="color: #fff;" class="am-badge am-badge-success am-radius">{{ $tag->name }}</a>
            @endforeach

            </h4>


  <p class="list-group-item-text">{{$post->summary}}</p>


    </div>

          @endforeach
     

      <p class="list-group-item-text">{{ $posts->links() }}</p>

 
  

  </div>
</div>
@stop