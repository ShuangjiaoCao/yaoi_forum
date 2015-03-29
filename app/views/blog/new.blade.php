@section('content')
  <h3 class="page-header">写文</h3>
  <form action="{{ URL::route('createPost') }}" method="post">
    <div class="form-group">
      <input name="title" class="form-control input-lg" type="text" placeholder="标题" />
    </div>
    <div class="form-group">
      <textarea name="content" class="form-control" rows="10" placeholder="文章内容"></textarea>
    </div>

        <div class="am-form-group">
          <label for="tags">Tags</label>
          <input id="tags" name="tags" type="text" value="{{ Input::old('tags') }}"/>
          <p class="am-form-help">多个Tag之间请输入","</p>
        </div>

    <input type="submit" class="btn btn-primary"/>
  </form>
@stop
