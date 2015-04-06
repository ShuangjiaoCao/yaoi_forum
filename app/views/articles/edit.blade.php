@extends('_layouts.default')



@section('content')

  <div class="am-g am-g-fixed">
   <div class="am-u-sm-12">

  <h3 class="page-header">修改文章</h3>
<!-- form  action="{{ URL::to('post/store') }}" method="post">-->
 @if ($errors->has())
    <div class="am-alert am-alert-danger" data-am-alert>
      <p>{{ $errors->first() }}</p>
    </div>
    @endif

<!-- {{ Form::open(array('url' => 'post', 'class' => 'form')) }}-->

{{ Form::model($post, array('url' => URL::route('post.update', $post->id), 'method' => 'PUT', 'class' => "form")) }}
   
	<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
 <div class="row form-inline" >


   		
	 	 <div class="input-group">

         <div class="form-group">



         <select name="isEnd" class="form-control">
          <option value="0">完结</option>
          <option value="1">连载</option>
      </select>


          </div>
        
        <div class="form-group">
        

    {{ Form::text('title', Input::old('title'),  array('class' => 'form-control'   ) ) }}

            
      
        </div>
      

      </div><!-- /input-group -->



    

  

      <div class="form-group">
        
      {{ Form::text('name', Input::old('name'),  array('class' => 'form-control', 'placeholder' => '作者马甲'  ) ) }}
       </div>


	
   <div class="form-group">
  		{{ Form::text('circle', Input::old('circle'),  array('class' => 'form-control', 'placeholder' => '圈子/作品'  ) ) }}
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



<div class="row form-inline" >
	 

  <div class="col-xs-6 col-md-4" >
    {{ Form::label('charakters', '人物/角色') }}
    {{ Form::text('charakters', Input::old('charakters')) }}
            <p class="am-form-help">多个角色之间可用入逗号或空格隔开</p>
  		</div>



   	
    <div class="col-xs-6 col-md-4" >
        {{ Form::label('cps', 'CP') }}
        {{ Form::text('cps', Input::old('cps')) }}
       <p class="am-form-help">多个CP之间可用入逗号或空格隔开</p>
  		</div>


 <div class="col-xs-6 col-md-4" >
		{{ Form::label('tags', '标签') }}
        {{ Form::text('tags', Input::old('tags')) }}
            <p class="am-form-help">多个标签之间可用入逗号或空格隔开</p>
  		</div>
  </div>

	

<div class="row" style="margin: 10px;padding: 10px;">
	  <div class="form-group col-md-8">
	

{{ Form::textarea('summary', Input::old('summary'), array('rows' => '1',  'class' => 'form-control', 'placeholder' => '一句话介绍'  ) ) }}


</div>
	 
 </div> 

   
  
<div class="row" style="margin: 10px;padding: 10px;">

    <div class="form-group col-md-8">

	{{ Form::textarea('content', Input::old('content'), array('rows' => '15',  'class' => 'form-control', 'placeholder' => '文章内容'  ) ) }}
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