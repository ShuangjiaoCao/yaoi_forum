@extends('_layouts.default')



@section('content')

  <div class="am-g am-g-fixed">
   <div class="am-u-sm-12">

  <h3 class="page-header">写文</h3>


<!-- form  action="{{ URL::to('post/store') }}" method="post">-->
 @if ($errors->has())
    <div class="am-alert am-alert-danger" data-am-alert>
      <p>{{ $errors->first() }}</p>
    </div>
    @endif

{{ Form::open(array('url' => 'post', 'class' => 'form')) }}
   
	<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
 <div class="row form-inline"  >

   
		 <div class="input-group">

  		 	 <div class="form-group">
     		 <select name="isEnd" class="form-control">
    			<option value="0">完结</option>
    			<option value="1">连载</option>
			</select>
   		    </div>
    		
    		<div class="form-group">
 				<input name="title" class="form-control" type="text" value="{{ Input::old('title') }}" placeholder="标题" />
  
    	

    	</div><!-- /input-group -->

    </div>·<!-- /ccol-xs-6 col-md-4-->
  


  	
      <div class="form-group">
  		<input name="name" class="form-control" type="text" value="{{ Input::old('name')}}" placeholder="作者马甲" /> 	
  	   </div>

  

	

      <div class="form-group">
      <input id="circlename_input" name="circle" class="form-control" type="text" value="{{ Input::old('circle')}}"  placeholder="圈子/作品" />
      </div>
    




		<div class="form-group has-error ">
  			<div class="checkbox">
    		<label>
     <input  name="is18" type="checkbox" value="0">
      有肉
    </label>
  </div>
 </div>

</div>  	


<div class="row form-inline"  style="margin: 10px;padding: 10px;">
	 

	<div class="col-xs-6 col-sm-3" >
    <input id="charakters" name="charakters"  placeholder="请添加人物/角色" type="text" value="{{ Input::old('charakters') }}"/>
            <p class="am-form-help">主要人物/角色</p>
  	
  	</div>

    <div class="col-xs-6 col-sm-3" >
   		 <input  id="cps" name="cps" type="text" value="{{ Input::old('cps') }}"  placeholder="请添加CP" >
          <p class="am-form-help">CP</p>
  	
  	     </div>

  	 <input id="tags" name="tags" type="text"  placeholder="请添加其他Tag" value="{{ Input::old('tags') }}"/>
            <p class="am-form-help">其他Tag</p>
  	

</div>


<div class="row" style="margin: 10px;padding: 10px;">
	  <div class="form-group col-md-8">
	
      <textarea name="summary" class="form-control" rows="1" placeholder="一句话介绍">{{ Input::old('summary') }}</textarea>

</div>
	 
 </div> 

   
  
<div class="row" style="margin: 10px;padding: 10px;">

    <div class="form-group col-md-8">
      <textarea name="content" class="form-control" rows="15" placeholder="文章内容">{{ Input::old('content') }}</textarea>
    </div>

       
 </div> 



<div class="row" style="margin: 10px;padding: 10px;">
<div class="col-md-8">
      <button type="submit" class="btn btn-primary btn-lg"> 发表 </button>
{{ Form::close() }}
    </div>
       
 </div> 
   
     </div> 
      </div> 


  <!-- /form>-->
@stop