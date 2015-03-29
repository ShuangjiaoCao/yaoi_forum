

@extends('_layouts.default')


@section('content')

<div class="am-g am-g-fixed">
    <div class="am-u-lg-6 am-u-md-8">
      <br/>

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



		<form role="form" class="am-form" method="post" action="{{ URL::route('postCreate') }}">
			<div class="form-group {{ ($errors->has('username')) ? ' has-error' : '' }}">
				<label for="username">Email: </lable>
					<input id="email" name="email" type="text" class="form-control">
					
			</div>
			<div class="form-group {{ ($errors->has('pass1')) ? ' has-error' : '' }}">
				<label for="pass1">密码: </lable>
					<input id="pass1" name="pass1" type="password" class="form-control">
					
			</div>
			<div class="form-group {{ ($errors->has('pass2')) ? ' has-error' : '' }}">
				<label for="pass2">密码确认: </lable>
					<input id="pass2" name="pass2" type="password" class="form-control">
					
			</div>
			{{ Form::token() }}
			<div class="am-cf">
				<input type="submit" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
			</div>
		</form>
		<br/>
	</div>
  </div>

@stop