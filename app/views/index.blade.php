@extends('_layouts.default')


@section('header-right')



<div class="am-g am-g-fixed">
  <div class="am-u-sm-12"  align="right">
 
  

@if(Auth::check())


  <a href="{{  URL::to('post/create')}}" class="btn btn-default btn-lg">
    <span class="glyphicon glyphicon-pencil"></span>
  </a>
  @endif

  

<button id="gonggao" style="margin:10px" class="am-btn am-btn-warning" data-am-modal="{target: '#information'}">服务器更新成功 开放注册！</button> </div>







<div class="container" id="informationC">
<div id="information"  class="am-modal am-modal-alert" tabindex="-1" id="my-alert">

  <div class="am-modal-dialog">
    <div class="am-modal-hd">菠菜的正确食用方法</div>

    <div class="am-modal-bd">

<div  align="left"> <font color="blue">大家好，我是菠菜的站长。很高兴这个坛子能及时和大家见面，在此介绍一下菠菜的一些特别食用方法:
</font>

<div data-am-widget="tabs" class="am-tabs am-tabs-default">
  <ul class="am-tabs-nav am-cf">
  <li class="">
      <a href="[data-tab-panel-0]">用户体验</a>
    </li>
    <li class="">
      <a href="[data-tab-panel-1]">标签和Autocomplete</a>
    </li>
    <li class="">
      <a href="[data-tab-panel-2]">高级搜索</a>
    </li>
    
    <li class="">
      <a href="[data-tab-panel-3]">服务器更换成功！</a>
    </li>
  </ul>
  <div class="am-tabs-bd">


    <div data-tab-panel-0 class="am-tab-panel ">
 <div style="padding:10px"> 
<font color="red">作者有 更文，修改、删除自己文章的权利，有肉的章节也请作者标记下来方便以后的管理。</font> 注册用户可以收藏文章。
游客可以自由看文，搜索，回帖，但无法发帖和看肉，<br />

 至于GN提出网站界面显示的各种问题，很抱歉由于本人对前端UI和交互式设计的能力非常渣，工作效率极其低下......现在勉强只能做到电脑显示正常的水平。在此也诚心希望能找到对Bootstrap，CSS，响应式设计比较熟悉的GN帮忙<br />
<br />
管理人员:<br />
<b>站长：</b>farrah<br/>
<b>论坛总版：</b>刀切馒头<br/>
<b>文库总版：</b>秋葵咖喱<br/>

<b>文库版主：</b>清蒸鲈鱼 红豆年糕  鱼头豆腐  可乐鸡翅  青椒炒肉  水晶虾饺  松仁玉米 <br/>


<center><font color=red size=4><b>联系我们</b></font><br/>联系邮箱：spinatesgl@163.com<br/>官方微博：@菠菜综合同人论坛
</center>

</div>
</div>







 <div data-tab-panel-1 class="am-tab-panel am-active">
 <div style="padding:10px"> 本站的标签分为<b>圈子</b>，<b>CP</b>，<b>角色</b>和<b>其他TAG</b>四种。   <br />圈子代表作品或者一个真人圈比如足球等等，CP和角色顾名思义，其他TAG主要包括一些比较敏感或者特殊的标签比如ABO，生子等等。 <font color="red">所有TAG均可直接点击进行查看</font> <br />
  <img id="aoto1" src='{{url("images/auto.png") }}'>  </img>
<p></p>
  在发文或者高级搜索里填写角色，圈子，CP和TAG的时候，想必大家也注意到了，系统是会自动补全你想填写的信息的。而这些推荐的词都是在大家发文的时候就已经存到了数据库里。 <font color="red">所以强烈大家在发文的时候规一定要范标签</font>，比如CP是AB，就不要写成AXB，如果你想写的CP填写的时候能在Autocomplete里面找到，直接用它就行了。如果你是一个开辟新CP的奠基人，也请务必为后来人做好榜样=v=<br />

  歪国人的情况比较麻烦，在此建议是希望大家名字尽量用英文，姓名可用斜杠隔开。 CP名字不要用字母缩写容易混淆。<br />
<p></p>
  规范TAG不仅可以方便大家以后在文多的时候容易分类搜索，也能节省版工们手动管理的时间。谢谢大家的配合！<br />

   
</div>
</div>
  

<div data-tab-panel-2 class="am-tab-panel">
    
 <div style="padding:10px"> 这个功能已经初见雏形，大家现在可以利用Autocomplete功能进行对任何圈子，CP和TAG的搜索。 <font color="red">注意比如在填写圈子名称的时候，如图所示，会自动出现相关内容，点击选择即可。如果框框下面没有出现你想搜索的圈子，则说明本站很遗憾并没有该圈的文章，就不用再做无用功啦。</font><br />
   <img id="aoto1" src='{{url("images/search2.png") }}'>  </img>
<p></p>
    如果只搜索圈子，结果里面除了所有该圈的文章之外还会显示该圈使用率最高的角色Top10和CP Top10，可以单独对其直接点击进行筛选。之后的将来可能还会出现选择按照评论数/收藏数/字数进行排列的功能什么的，看时间啦 <br /> </div>    <img id="aoto1" src='{{url("images/cps.png") }}'>  </img>
</div>





    <div data-tab-panel-3 class="am-tab-panel">
     <div style="padding:10px"> 
 看到这条消息就说明服务器已经更新完毕！现在正式开放注册，大家可以愉快地玩耍了=v= <br />

    </div>
</div>
</div>
</div>

       
      </div>


    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn">太长不看</span>
    </div>
  </div>
</div>

</div>

 </div>

@stop



@section('content')


<div class="am-g am-g-fixed">
  <div class="am-u-sm-12">

    
    @foreach ($posts as $post)


        <div class="list-group-item list-group-item-info">
    

         <span class="badge">{{$post->getNumCommentsStr()}}</span>





 	   <h4 class="list-group-item-heading"> 
  
      
  @if ($post->top !=1)

  @if ($post->isEnd==0)
  <img id="wanjie" src='{{url("images/wanjie2.png") }}'>  </img>
 @else 
 <img id="lianzai" src='{{url("images/lianzai.png") }}'>  </img>
  @endif 

  @else
  <img id="gonggao" src='{{url("images/gonggao.png") }}'>  </img>
    @endif 

  



       
       <a href="{{ URL::to('circle/' . $post->circle_id . '/posts') }}" id="circlename" class="am-badge am-badge-warning am-radius"> {{{$post->circle->name}}}</a>
              @foreach ($post->cps as $cp)
                  <a href="{{ URL::to('cp/' .  $cp->id . '/posts') }}" id="cpname" class="am-badge am-badge-warning am-radius">{{ $cp->name }}</a>
              @endforeach





      <a href="{{ URL::route('post.show', $post->id) }}" style="font-size : 20px;">
           
         {{{ $post->title }}} 
        </a>


         @if ($post->is18==1)
     <img id="meat" src='{{url("images/R1.png") }}'>  </img>
     @endif 


        @if ($post->top==1)
          <span id="topfond" style="color:red">  置顶  </span>
        @endif 
        


   
        <span style="padding-right:10px" class="pull-right">
        @if ($post->is_admin==1)
        <small> {{  $post->updated_at->diffForHumans() }} 作者: <font color="green">{{ $post->name }}</font>  </small> 
        @else 


         <small> {{  $post->updated_at->diffForHumans() }}    作者:{{  $post->name }}  </small> 

          @endif 
        </span>     
          
       


   

 			
        </h4>


	<div id="summarylist" class="list-group-item-text">{{$post->summary}}</div>


    </div>

        
      @endforeach

      <p class="list-group-item-text">{{ $posts->links() }}</p>

    </div>
  </div>

@stop

