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
      {{ Form::model($user, array('url' => 'user/' . $user->id, 'method' => 'PUT', 'class' => 'am-form')) }}
        {{ Form::label('email', 'E-mail:') }}
        <input id="email" name="email" type="email" readonly="readonly" value="{{ $user->email }}"/>
        <br/>
        {{ Form::label('nickname', '马甲:') }}
        <input id="nickname" name="nickname" type="text" value=" "/>
        <br/>
        {{ Form::label('old_password', '旧密码:') }}
        {{ Form::password('old_password') }}
        <br/>
        {{ Form::label('pass1', '新密码:') }}
        {{ Form::password('pass1') }}
        <br/>
        {{ Form::label('pass2', '确认新密码:') }}
        {{ Form::password('pass2') }}
        <br/>
        <div class="am-cf">
          {{ Form::submit('修改', array('class' => 'am-btn am-btn-primary am-btn-sm am-fl')) }}
        </div>
      {{ Form::close() }}
      <br/>
    </div>
  </div>
@stop