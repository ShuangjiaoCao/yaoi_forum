@extends('_layouts.default')

@section('content')


 <div class="am-g am-g-fixed blog-g-fixed">
        
        <!--/span-->
        <div class="col-md-8">
 @if ($errors->has())
    <div class="am-alert am-alert-danger" data-am-alert>
      <p>{{ $errors->first() }}</p>
    </div>
    @endif
    
            <div class="panel-body panel-list-group">
    <div class="list-group">
    @foreach ($posts as $post)


        <div class="list-group-item list-group-item-info">
         <span class="badge">{{$post->getNumCommentsStr()}}</span>

     <h4 class="list-group-item-heading"> 
       <a id="circlename" href="{{ URL::to('circle/' . $post->circle_id . '/posts') }}" class="am-badge am-badge-warning am-radius"> {{{$post->circle->name}}}</a>
              @foreach ($post->cps as $cp)
                  <a  href="{{ URL::to('cp/' .  $cp->id . '/posts') }}" id="cpname" class="am-badge am-badge-warning am-radius">{{ $cp->name }}</a>
              @endforeach
 
      <a href="{{ URL::route('post.show', $post->id) }}">
        {{{ ($post->isEnd == 0) ? '[完结]' : '[连载]'}}}  
            {{{ $post->title }}}
        </a>

         <small>{{  $post->updated_at->diffForHumans() }}  by {{  $post->name }}  </small> 
    
      @foreach ($post->tags as $tag)
        <span  href="{{ URL::to('tag/' . $tag->id . '/posts') }}" style="color: #fff;" class="am-badge am-badge-success am-radius">{{ $tag->name }}</span>
            @endforeach

        </h4>


  <p class="list-group-item-text">{{$post->summary}}</p>


    </div>

        
      @endforeach

      <p class="list-group-item-text">{{ $posts->links() }}</p>

    </div>
  </div>
        </div>
        <!--/span-->


        <div class="col-md-4">
            <div class="sidebar-nav-fixed pull-right affix">
                <div class="well">
                    <ul class="nav ">
                        <li class="nav-header"> <big> -> <a>{{ $circle!=null  ?   
                        $circle->name :  ''}}</a> 
                         <a>{{ $charakter_input!=null  ?    $charakter_input->name :  ''}}</a>
                        <a> {{ $cp_input!=null  ?    $cp_input->name:  ''}}</a>
                        <a> {{ $tag_input!=null  ?    $tag_input->name:  ''}} </a>
                         <a> {{ $status!=null  ?         $status:  ''}} </a>
                         </big> </li>

<li class="active">

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          角色Top10
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
      @foreach ($charakters as $charakter)
                  <a href="{{ URL::to('charakter/' . $charakter->id . '/posts') }}" id="chname" class="am-badge am-badge-default am-radius">{{ $charakter->name }} <span class="badge">{{$charakter->count}}</span> </a>
          @endforeach
         

      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          CP Top10
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
         @foreach ($cps as $cp)
                  <a  href="{{ URL::to('cp/' . $cp->id . '/posts') }}"  id="cpname2" class="am-badge am-badge-default am-radius">{{ $cp->name }} <span class="badge">{{$cp->count}}</span> </a>
          @endforeach
      </div>
    </div>
  </div>
</div>
            </li>               
                        
                        
                        
                    </ul>
                </div>
                <!--/.well -->
            </div>
            <!--/sidebar-nav-fixed -->
        </div>
        <!--/span-->
    </div>
    <!--/row-->


<!--/.fluid-container-->


<div>

</div>

@stop