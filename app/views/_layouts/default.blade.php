<!DOCTYPE html>
<html>
<head lang="zh">
  <meta charset="UTF-8"/>
  <title>同人论坛</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no"/>
  <meta name="renderer" content="webkit"/>
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <link rel="alternate icon" type="image/x-icon" href="{{ URL::asset('i/favicon.ico') }}"/>

  <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
  <link href="/css/amazeui.min.css" rel="stylesheet" type="text/css">
<link href="/css/jquery.tagit.css" rel="stylesheet" type="text/css">




   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" />
    
  <link rel="stylesheet" type="text/css" href="/css/style.css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />



  {{ HTML::style('css/custom.css') }}
</head>
<body>
<header class="am-topbar am-topbar-fixed-top am-topbar-inverse">

  <div class="am-container">
         <a href="/" class="navbar-brand">同人论坛</a> 
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>


<script src="http://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>





  

    <script type="text/javascript" src='//code.jquery.com/jquery-1.10.2.min.js'></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    

     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>




  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 <script type="text/javascript" src='{{url("js/zepto.min.js") }}'></script>

 <script type="text/javascript" src='{{url("js/amazeui.min.js") }}'></script>
  
    <script type="text/javascript" src='{{url("js/tag-it.js") }}'></script>

    <script type="text/javascript" src= '{{url("js/bootstrap.js") }}'></script>
     
    <script type="text/javascript" src='{{ url("js/main.js") }}'></script>



    
    @yield('scripts')


</body>
</html>
