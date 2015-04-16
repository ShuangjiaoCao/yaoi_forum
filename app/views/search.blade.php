@extends('_layouts.default')

@section('content')
<div class="am-g am-g-fixed blog-g-fixed">
  <div class="am-u-sm-12">

 @if ($errors->has())
    <div class="am-alert am-alert-danger" data-am-alert>
      <p>{{ $errors->first() }}</p>
    </div>
    @endif

<ul id="halloworld" class="nav nav-tabs">
  <li role="presentation" class="active"><a href="javascript:activateTab('searchpage1')">一般搜索</a></li>
  <li role="presentation"><a href="javascript:activateTab('searchpage2')">高级搜索</a></li>

</ul>


 <div id="tabCtrl">



<!---->



 <div  id="searchpage1" style="display: block;" class="row"> 


   {{ Form::open(array('url' => 'search_normal', 'class' => 'form')) }}

    <div class="row"  >
  <div class="col-lg-6">

  	
    <div class="form-inline">
		<div class="form-group">
     		 <select name="searchtype" class="form-control">
    			<option value="0">按照题目</option>
    			<option value="1">按照作者</option>
			</select>
   		    </div>


     <input name="normal_search" id="normal_search" type="text" class="form-control" placehoder="搜索" >
     
    </div><!-- /input-group -->


  </div><!-- /.col-lg-6 -->
    </div>  <!-- /.inline -->

    <button class="btn btn-info" type="submit">
    <span class="glyphicon glyphicon-search"></span> 搜索
  </button>


  {{ Form::close() }}



</div><!-- /.row-->




 <div  id="searchpage2" style="display: none;" class="row"> 
  {{ Form::open(array('url' => 'search_komplex', 'class' => 'form')) }}
  	<div class="col-lg-6">



 	
 		 <div class="form-inline" style="margin: 10px;padding: 10px;">

			
			<div class="form-group">
     		 <select id="isEnd" name="isEndSearch" class="form-control"> 
     		    <option value="0">无所谓</option>
    			<option value="1">连载</option>
    			<option value="2">完结</option>
			</select>
   		    </div>


 		<label>按照圈子/作品: </label>
   		<div class="form-group">
          <input id="circle_search" name="circles_search"  class="form-control" placeholder="搜索圈子/作品" type="text" />
            
  		</div>



  		</div>
  
 		
 			
 		


		


     <div class="form-inline"  style="margin: 10px;padding: 10px;">
		<label>按照人物/角色: </label>
   		<div class="form-group">
          <input id="charakters_search" name="charakters_search"  class="form-control" placeholder="搜索人物/角色" type="text" />
        	   
  		</div>
  			</div>		




    <div class="form-inline" style="margin: 10px;padding: 10px;">
  		<label >按照CP搜索:  </label>
   		
          <input id="cps_search" name="cps_search"  class="form-control" placeholder="搜索CP" type="text" />
           		
  		</div>


    <div class="form-inline" style="margin: 10px;padding: 10px;">
  		<label >按照其他标签: </label>
   		
          <input id="tags_search" name="tags_search"  class="form-control" placeholder="搜索其他标签" type="text" />
            
  		
		</div>

<button class="btn btn-info" type="submit">
    <span class="glyphicon glyphicon-search"></span> 搜索
  </button>


  </div><!-- /.col-lg-6 -->
  
  {{ Form::close() }}	

</div> <!-- /.row-->




	</div>



 



		</div>

  </div>













@stop