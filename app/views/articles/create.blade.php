@extends('_layouts.default')



@section('content')

  <div class="am-g am-g-fixed">
   <div class="am-u-sm-12">

  <h3 class="page-header">写文</h3>
  <div style="color:#0e90d2">注: 蓝框为必填项, 多个CP、角色、其他TAG之间可用逗号或者空格分开</div>


<!-- form  action="{{ URL::to('post/store') }}" method="post">-->
 @if ($errors->has())
    <div class="am-alert am-alert-danger" data-am-alert>
      <p>{{ $errors->first() }}</p>
    </div>
    @endif

{{ Form::open(array('url' => 'post', 'class' => 'form')) }}
   



	<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->

 <div class="am-g  form-inline" style="margin: 10px;padding: 10px;">
<div class="am-u-lg-4">
   
		 <div class="input-group">

  		 	 <div class="form-group">
     		 <select data-am-selected="{btnWidth: 100, btnSize: 'sm', btnStyle: 'secondary'}" name="isEnd" class="form-control">
    			<option value="0">完结</option>
    			<option value="1">连载</option>
			</select>
   		    </div>
    		
    		<div class="form-group">
 				<input name="title"; id="inputtitle" class="form-control" type="text" value="{{ Input::old('title') }}" placeholder="标题" />

    	</div>

    </div>
     </div>
  


  	<div class="am-u-lg-3">
      <div class="form-group">
  		<input name="name" id="inputname"class="form-control" type="text" value="{{ Input::old('name')}}" placeholder="作者马甲" /> 	
  	   </div>
        </div>

  

	
  <div class="am-u-lg-3">  
      <div class="form-group">
      <input id="circlename_input"  name="circle" class="form-control" type="text" value="{{ Input::old('circle')}}"  placeholder="圈子/作品" />
      </div>
    
</div>

  <div class="am-u-lg-2"> 
		<div class="form-group has-error ">
  			<div class="checkbox">
    		<label>
     <input  name="is18" type="checkbox" value="0">
      有肉
    </label>
  </div>
 </div>
</div>

  </div>

</div>  	

 <div class="am-g  form-inline" style="margin: 10px;padding: 10px;">
	 

<div class="am-u-lg-4">
    <input id="charakters" name="charakters" type="text" value="{{ Input::old('charakters') }}"/>
            <p class="am-form-help">主要人物/角色</p>
  	
  	</div>

   <div class="am-u-lg-4">
   		 <input  id="cps" name="cps" type="text" value="{{ Input::old('cps') }}" >
          <p class="am-form-help">CP</p>
  	
  	     </div>


<div class="am-u-lg-4">
  	 <input id="tags" name="tags" type="text"  value="{{ Input::old('tags') }}"/>
            <p class="am-form-help">其他Tag</p>
  	

</div>
</div> 

 <div class="am-g" style="margin: 10px;padding: 10px;">
   <div class="am-u-lg-12">

	  <div class="form-group">
	
      <textarea name="summary" id="inputsummary" class="form-control" rows="1" placeholder="一句话介绍">{{ Input::old('summary') }}</textarea>

</div>
	 </div>
   </div>


    <div class="am-g" style="margin: 10px;padding: 10px;">
  <div class="am-u-lg-12">
    <div class="form-group">
      <textarea name="content" id="inputcontent" class="form-control" rows="15" placeholder="文章内容">{{ Input::old('content') }}</textarea>
    </div>
 </div>
       
 </div> 



 <div class="am-g  form-inline" style="margin: 10px;padding: 10px;">
<div class="am-u-sm-3 am-u-sm-centered">
      <button type="submit" class="btn btn-primary btn-lg"> 发表 </button>

    </div>

   
   
 </div> 
  {{ Form::token() }}
   {{ Form::close() }}    
     </div> 
      </div> 


  <!-- /form>-->
@stop