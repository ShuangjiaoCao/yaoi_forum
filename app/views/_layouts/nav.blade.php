



<button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-secondary am-show-sm-only"
        data-am-collapse="{target: '#collapse-head'}"><span class="am-sr-only">nav switch</span>
        <span class="am-icon-bars"></span></button>




<div class="am-collapse am-topbar-collapse" id="collapse-head">
  
@if (Auth::check() &&Auth::user()->is_admin)
<ul class="am-nav am-nav-pills am-topbar-nav">
  <li><a href="{{ URL::to('admin/tags') }}">标签</a></li>
</ul>


@endif

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right">




    @if (Auth::check())
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> {{{ Auth::user()->email }}} <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
         
          <li><a id="test123" href="{{ URL::to('user/'. Auth::id() . '/posts') }}"><span class="am-icon-list"></span> 我的文章 </a></li>

          <li><a href="{{ URL::to('user/'. Auth::id() . '/lieblings') }}"><span class="am-icon-heart"></span> 我的收藏</a></li>

          <li><a href="{{ URL::to('user/'. Auth::id() . '/edit') }}"><span class="am-icon-user"></span> 个人信息</a></li>

           <li><a href="{{ URL::to('logout') }}"><span class="am-icon-power-off"></span> 登出</a></li>
        </ul>
      </li>
  



  @else

  <div class="am-topbar-right">
    <a href="{{ URL::to('login') }}" class="am-btn am-btn-secondary am-topbar-btn am-btn-sm topbar-link-btn"><span class="am-icon-user"></span>登录</a>
  </div>

  <div class="am-topbar-right">
    <a href="{{ URL::to('create') }}" class="am-btn am-btn-secondary am-topbar-btn am-btn-sm topbar-link-btn"><span class="am-icon-pencil"></span>注册</a>
  </div>


  
@endif

  <div class="am-topbar-right">
  <a href="{{ URL::to('search') }}" class="am-btn am-btn-secondary am-topbar-btn am-btn-sm topbar-link-btn"> <span class="am-icon-search"></span>  </a>
  </div>



  </ul>
 </div>

