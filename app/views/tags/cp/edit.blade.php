@extends('_layouts.default')

@section('content')
<div class="am-g am-g-fixed">
  <div class="am-u-sm-12">
  	<h1>修改CP</h1>
  	<hr/>
  @if (Session::has('message'))
    <div class="am-alert am-alert-{{ Session::get('message')['type'] }}" data-am-alert>
      <p>{{ Session::get('message')['content'] }}</p>
    </div>
  @endif
	@if ($errors->has())
	<div class="am-alert am-alert-danger" data-am-alert>
	  <p>{{ $errors->first() }}</p>
	</div>
	@endif




    {{ Form::model($cp, array('url' => URL::route('cp.update', $cp->id), 'method' => 'PUT', 'class' => "am-form")) }}
	    <div class="am-form-group">
        {{ Form::label('name', 'TagName') }}
        {{ Form::text('name', Input::old('name')) }}
	    </div>
	    <p><button type="submit" class="am-btn am-btn-success">
        <span class="am-icon-pencil"></span> 修改</button>
      </p>
	{{ Form::close() }}


  
  </div>
</div>
@stop