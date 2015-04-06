@extends('_layouts.default')


@section('header-right')


<div class="row"  style="margin-top: 10px; margin-right: 17%" align="right">
  
  	
@if(Auth::check())
  <a href="{{  URL::to('post/create')}}" class="btn btn-default btn-lg">
    <span class="glyphicon glyphicon-pencil"></span>
  </a>
  @endif

  
</div>

 


@stop



@section('content')



<div class="am-g am-g-fixed">
  <div class="am-u-sm-12">


    @foreach ($posts as $post)


        <div class="list-group-item list-group-item-info">
         <span class="badge">{{$post->getNumCommentsStr()}}</span>

 	   <h4 class="list-group-item-heading"> 
       <a href="{{ URL::to('circle/' . $post->circle_id . '/posts') }}" id="circlename" class="am-badge am-badge-warning am-radius"> {{{$post->circle->name}}}</a>
              @foreach ($post->cps as $cp)
                  <a href="{{ URL::to('cp/' .  $cp->id . '/posts') }}" id="cpname" class="am-badge am-badge-warning am-radius">{{ $cp->name }}</a>
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

