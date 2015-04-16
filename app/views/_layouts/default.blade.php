<!DOCTYPE html>
<html>
<head lang="zh">
  <meta charset="UTF-8"/>
  <title>菠菜</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0, user-scalable=yes">

  <meta name="format-detection" content="telephone=no"/>
  <meta name="renderer" content="webkit"/>
  <meta http-equiv="Cache-Control" content="no-siteapp"/>


  <link rel="alternate icon" type="image/x-icon" href="{{ URL::asset('i/favicon.ico') }}"/>

<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css">
  <link href="/css/amazeui2_3.min.css" rel="stylesheet" type="text/css">


  <link href="/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="/css/jquery.tagit.css" rel="stylesheet" type="text/css">




  
  <link rel="stylesheet" type="text/css" href="/css/style.css">





  {{ HTML::style('css/custom.css') }}
</head>
<body>
<header class="am-topbar am-topbar-fixed-top am-topbar-inverse">

  <div class="am-container">

         <a href="/" class="navbar-brand">  <img id="logo" src='{{url("images/logo.png") }}'>  </img></a>

       
    @include('_layouts.nav')

  </div>

</header>


<div>
 
   @yield('header-right')

</div>



@yield('content')

@yield('content2')
 

@include('_layouts.footer')

<script type="text/javascript">
        var root = '{{url("/")}}';
    </script>



 <script type="text/javascript" src='{{url("js/jquery.min.js") }}'></script>
 <script type="text/javascript" src='{{url("js/amazeui.min.js") }}'></script>

 
  <script type="text/javascript" src='{{url("js/jquery-1.10.2.js") }}'></script>
   <script type="text/javascript" src='{{url("js/jquery-ui.js") }}'></script>






  
    <script type="text/javascript" src='{{url("js/tag-it.js") }}'></script>

    <script type="text/javascript" src= '{{url("js/bootstrap.js") }}'></script>
     
    <script type="text/javascript" src='{{ url("js/main.js") }}'></script>



    
    @yield('scripts')


</body>
</html>
