@extends('_layouts.default')

@section('content')
<article class="am-article">
  <div class="am-g am-g-fixed">
      <div class="am-u-sm-12">
        <br/>
        <div class="am-article-hd">
          <h1 class="am-article-title">{{{ $post->title }}}</h1>
          <p class="am-article-meta">作者: <a style="cursor: pointer;">{{{ $post->name }}}</a> 发表时间{{ $post->updated_at }}</p>
        </div>
        <div class="am-article-bd">

        <span class="label label-danger">{{ ($post->is18 == true) ? '有肉' : ''  }}</span>

      


            <blockquote>
              标签:
              @foreach ($post->tags as $tag)
                  <a class="am-badge am-badge-success am-radius">{{ $tag->name }}</a>
              @endforeach
            </blockquote>  

    <div class="am-article-lead">
          <p>{{ $post->summary }}</p>
    </div>


          </p>
          <p>{{ $post->resolved_content }}</p>
        </div>
        <br/>
      </div>
  </div>
</article>
@stop
