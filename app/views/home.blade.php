@extends('_layouts.default')

@section('content')
<div class="am-g am-g-fixed blog-g-fixed">
  <div class="am-u-sm-12">
      <table class="am-table am-table-hover am-table-striped ">
      <thead>
      <tr>
        <th>题目</th>
        <th>标签</th>
        @if ($user->id == Auth::id())
        <th>管理</th>
        @endif
      </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td>{{{ $post->title }}}</td>
          <td>
          @foreach ($post->tags as $tag)
            <span class="am-badge am-badge-success am-radius">{{ $tag->name }}</span>
          @endforeach
          </td>
          @if ($user->id == Auth::id())
            <td>
              <a href="{{ URL::to('post/'. $post->id . '/edit') }}" class="am-btn am-btn-xs am-btn-primary"><span class="am-icon-pencil"></span> 编辑</a>
              {{ Form::open(array('url' => 'post/' . $post->id, 'method' => 'DELETE', 'style' => 'display: inline;')) }}
                  <button type="button" class="am-btn am-btn-xs am-btn-danger" id="delete{{ $post->id }}"><span class="am-icon-remove"></span> 删除</button>
              {{ Form::close() }}
            </td>
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
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
<script>


  $(function() {
  
  });
</script>
@stop