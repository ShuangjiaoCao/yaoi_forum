@extends('_layouts.default')

@section('content')
<div class="am-g am-g-fixed blog-g-fixed">
  <div class="am-u-sm-12">

<div data-am-widget="tabs" class="am-tabs am-tabs-default">
  <ul class="am-tabs-nav am-cf">
    <li class="">
      <a href="[data-tab-panel-0]">圈子</a>
    </li>
    <li class="">
      <a href="[data-tab-panel-1]">角色</a>
    </li>
    <li class="">
      <a href="[data-tab-panel-2]">CP</a>
    </li>
    <li class="">
      <a href="[data-tab-panel-3]">TAG</a>
    </li>
  </ul>
  <div class="am-tabs-bd">

 <div data-tab-panel-0 class="am-tab-panel am-active">
 <table class="am-table am-table-hover am-table-striped " style="inline">
      <thead>
      <tr>
        <th>圈子</th>
        <th>数量</th>
        <th>管理</th>
      </tr>
      </thead>
      
      <tbody>
        @foreach ($circles as $circle)
        <tr>
          <td>{{{$circle->name }}}</td>
          <td>{{ $circle->count }}</td>
          <td>
            <a href="{{ URL::to('circle/'. $circle->id . '/edit') }}" class="am-btn am-btn-xs am-btn-primary"><span class="am-icon-pencil"></span></a>

            {{ Form::open(array('url' => 'circle/' . $circle->id, 'method' => 'DELETE', 'style' => 'display: inline;')) }}
              <button type="submit" value="delete" class="am-btn am-btn-xs am-btn-danger" id="delete{{$circle->id}}"><span class="am-icon-remove"></span></button>

            {{ Form::close() }}
          </td>

        </tr>
        @endforeach
      </tbody>
    </table>
     <div> {{ $circles->links() }}  </div> 
</div>
  



<div data-tab-panel-1 class="am-tab-panel">
     <table class="am-table am-table-hover am-table-striped ">
      <thead>
      <tr>
        <th>角色</th>
        <th>数量</th>
        <th>管理</th>
      </tr>
      </thead>
      
      <tbody>
        @foreach ($charakters as $charakter)
        <tr>
          <td>{{{$charakter->name }}}</td>
          <td>{{ $charakter->count }}</td>
          <td>
            <a href="{{ URL::to('charakter/'. $charakter->id . '/edit') }}" class="am-btn am-btn-xs am-btn-primary"><span class="am-icon-pencil"></span></a>

            {{ Form::open(array('url' => 'charakter/' . $charakter->id, 'method' => 'DELETE', 'style' => 'display: inline;')) }}
              <button type="submit" value="delete" class="am-btn am-btn-xs am-btn-danger" id="delete{{$charakter->id}}"><span class="am-icon-remove"></span></button>

            {{ Form::close() }}
          </td>

        </tr>
        @endforeach
      </tbody>
    </table>
 <div> {{ $charakters->links() }}  </div> 
</div>


    <div data-tab-panel-2 class="am-tab-panel ">

 <table class="am-table am-table-hover am-table-striped ">
  <thead>
      <tr>
        <th>CP</th>
        <th>数量</th>
        <th>管理</th>
      </tr>
      </thead>
      
      <tbody>
        @foreach ($cps as $cp)
        <tr>
          <td>{{{$cp->name }}}</td>
          <td>{{ $cp->count }}</td>
          <td>
            <a href="{{ URL::to('cp/'. $cp->id . '/edit') }}" class="am-btn am-btn-xs am-btn-primary"><span class="am-icon-pencil"></span></a>

            {{ Form::open(array('url' => 'cp/' . $cp->id, 'method' => 'DELETE', 'style' => 'display: inline;')) }}
              <button type="submit" value="delete" class="am-btn am-btn-xs am-btn-danger" id="delete{{$cp->id}}"><span class="am-icon-remove"></span></button>

            {{ Form::close() }}
          </td>

        </tr>
        @endforeach
      </tbody>
    </table>
     <div> {{ $cps->links() }}  </div> 


</div>


    <div data-tab-panel-3 class="am-tab-panel">

      <table class="am-table am-table-hover am-table-striped " >
      <thead>
      <tr>
        <th>TAG</th>
        <th>数量</th>
        <th>管理</th>
      </tr>
      </thead>

      <tbody>
        @foreach ($tags as $tag)
        <tr>
          <td>{{{$tag->name }}}</td>
          <td>{{ $tag->count }}</td>
          <td>
            <a href="{{ URL::to('tag/'. $tag->id . '/edit') }}" class="am-btn am-btn-xs am-btn-primary"><span class="am-icon-pencil"></span></a>

            {{ Form::open(array('url' => 'tag/' . $tag->id, 'method' => 'DELETE', 'style' => 'display: inline;')) }}
              <button type="submit" value="delete" class="am-btn am-btn-xs am-btn-danger" id="delete{{$tag->id}}"><span class="am-icon-remove"></span></button>

            {{ Form::close() }}
          </td>

        </tr>
        @endforeach
      </tbody>
    </table>
     <div> {{ $tags->links() }}  </div> 
</div>



</div>
</div>

</div>

  </div>




<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">删除TAG</h4>
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



@stop