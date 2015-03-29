@extends('_layouts.default')


@section('header-right')


<div class="row"  style="margin-top: 10px; margin-right: 20px;" align="right">
  
  	
@if(Auth::check())
  <a href="{{  URL::to('post/create')}}" class="btn btn-default btn-lg">
    <span class="glyphicon glyphicon-pencil"></span>
  </a>
  @endif

  
</div>

 


@stop



@section('content')





<div class="panel-body panel-list-group">
    <div class="list-group">
    @foreach ($posts as $post)


        <a href="{{ URL::route('post.show', $post->id) }}" class="list-group-item list-group-item-info">
         <span class="badge">{{$post->getNumCommentsStr()}}</span>
        <h4 class="list-group-item-heading">{{ ($post->isEnd == true) ? '[完结]' : '[连载]'  }}  	{{ $post->title }}  <small>{{  $post->updated_at->diffForHumans() }}  </small> </h4>

		


   		<p class="list-group-item-text">{{$post->summary}}</p>
   		

    </a>

        
      @endforeach
    </div>
  </div>

@stop

