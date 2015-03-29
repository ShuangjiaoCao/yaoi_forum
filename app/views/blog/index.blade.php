 

@section('header-right')
@if(Auth::check())
  <a href="{{  URL::to('post/create')}}" class="btn btn-default btn-lg">
    <span class="glyphicon glyphicon-pencil"></span>
  </a>
  @endif
@stop

@section('content')


<div class="panel-body panel-list-group">
    <div class="list-group">
    @foreach ($posts as $post)


        <a href="{{ URL::to('post/create, $post->id') }}" class="list-group-item list-group-item-info">{{ $post->title }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$post->created_at()->diffForHumans();}}
    <span class="badge">{{$post->getNumCommentsStr()}}</span>

    </a>

        
      @endforeach
    </div>
  </div>

<div class="panel-body panel-list-group">
    <div class="list-group">
      <h1>Welcome {{{ Auth::user()->email }}}</h1>
       <h1>Welcome {{{ Auth::user()->email }}}</h1>
    </div>
  </div>





 
@stop
