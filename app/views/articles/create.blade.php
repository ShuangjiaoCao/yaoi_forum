@extends('_layouts.default')



@section('content')



  <h3 class="page-header">写文</h3>
<!-- form  action="{{ URL::to('post/store') }}" method="post">-->
 @if ($errors->has())
    <div class="am-alert am-alert-danger" data-am-alert>
      <p>{{ $errors->first() }}</p>
    </div>
    @endif

{{ Form::open(array('url' => 'post', 'class' => 'form')) }}
   
	<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
 <div class="row form-inline" style="margin: 10px;padding: 10px;" >

	<div class="col-xs-2">
   		<div class="form-group">
	 		<input name="circle" class="form-control" type="text" placeholder="圈子/作品" />
  		</div>
  	</div>


  	<div class="col-xs-6 col-sm-3">  
		 <div class="input-group">

  		 	 <div class="form-group">
     		 <select name="isEnd" class="form-control">
    			<option value="0" selected="selected">完结</option>
    			<option value="1">连载</option>
			</select>
   		    </div>
    		
    		<div class="form-group">
 				<input name="title" class="form-control" type="text" value="{{ Input::old('title') }}" placeholder="标题" />
  			</div>
    	

    	</div><!-- /input-group -->

    </div>·<!-- /ccol-xs-6 col-md-4-->
  


  	<div class="col-xs-2">
      <div class="form-group">
  		<input name="name" class="form-control" type="text" placeholder="作者马甲" /> 	
  	   </div>

  	</div>

	

	<div class="col-xs-2">
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


<div class="row form-inline"  style="margin: 10px;padding: 10px;">
	 

	<div class="col-xs-6 col-sm-3" >
   		<div class="form-group">
	 		 <label for="tags">人物/角色</label>
          <input id="tags" name="tags" type="text" value="{{ Input::old('tags') }}"/>
            <p class="am-form-help">多个角色之间请输入","</p>
  		</div>
  	</div>

<div class="col-xs-6 col-sm-3" >
   		<div class="form-group">
	 		 <label for="tags">CP</label>
          <input id="tags" name="tags" type="text" value="{{ Input::old('tags') }}"/>
            <p class="am-form-help">多个CP之间请输入","</p>
  		</div>
  	</div>

  	<div class="col-xs-6 col-sm-3" >
   		<div class="form-group">
	 		 <label for="tags">标签</label>
          <input id="tags" name="tags" type="text" value="{{ Input::old('tags') }}"/>
            <p class="am-form-help">多个标签之间请输入","</p>
  		</div>
  	</div>

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
   
  


  <!-- /form>-->
@stop