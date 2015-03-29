@extends('_layouts.default')

@section('main')
<div class="am-g am-g-fixed blog-g-fixed">
  <div class="am-u-sm-12">
      <h1>Welcome {{{ Auth::user()->email }}}</h1>
  </div>
</div>
@stop