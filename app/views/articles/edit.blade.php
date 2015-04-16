@extends('_layouts.default')



@section('content')

  <div class="am-g am-g-fixed">
   <div class="am-u-sm-12">

  <h3 class="page-header">修改文章</h3>
    <div style="color:#0e90d2">注: 蓝框为必填项, 多个CP、角色、其他TAG之间可用逗号或者空格分开</div>
<!-- form  action="{{ URL::to('post/store') }}" method="post">-->
 @if ($errors->has())
    <div class="am-alert am-alert-danger" data-am-alert>
      <p>{{ $errors->first() }}</p>
    </div>
    @endif

<!-- {{ Form::open(array('url' => 'post', 'class' => 'form')) }}-->

{{ Form::model($post, array('url' => URL::route('post.update', $post->id), 'method' => 'PUT', 'class' => "form")) }}
   
	<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
 <div class="am-g  form-inline" style="margin: 10px;padding: 10px;">
<div class="am-u-sm-6 am-u-md-6 am-u-lg-4">

   		
	 	 <div class="input-group">

         <div class="form-group">



        <select data-am-selected="{btnWidth: 100, btnSize: 'sm', btnStyle: 'secondary'}" name="isEnd" class="form-control">
          <option value="0">完结</option>
          <option value="1">连载</option>
      </select>


          </div>


<div class="form-group">
{{ Form::text('title', Input::old('title'),  array('class' => 'form-control','placeholder' => '标题','id' => 'inputtitle'   ) ) }}
      </div>

       </div> 
 </div>


    
<div class="am-u-lg-3">
      <div class="form-group">
        {{ Form::text('name', Input::old('name'),  array('class' => 'form-control', 'placeholder' => '作者马甲','id' => 'inputname'  ) ) }}  
       </div>
        </div>


	  <div class="am-u-lg-3">  
      <div class="form-group">
        {{ Form::text('circle', Input::old('circle'),  array('class' => 'form-control', 'placeholder' => '圈子/作品', 'id' => 'circlename_input'  ) ) }}
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
    {{ Form::label('charakters', '人物/角色') }}
    {{ Form::text('charakters', Input::old('charakters')) }}
    
    </div>


<div class="am-u-lg-4">
        {{ Form::label('cps', 'CP') }}
        {{ Form::text('cps', Input::old('cps')) }}
</div>



<div class="am-u-lg-4">
		{{ Form::label('tags', '标签') }}
        {{ Form::text('tags', Input::old('tags')) }}
  		</div>
  </div>

	

 <div class="am-g" style="margin: 10px;padding: 10px;">
   <div class="am-u-lg-12">

    <div class="form-group">
  
      {{ Form::textarea('summary', Input::old('summary'), array('rows' => '1',  'class' => 'form-control', 'placeholder' => '一句话介绍', 'id'=>'inputsummary'  ) ) }}

</div>
   </div>
   </div>


   <div class="am-g" style="margin: 10px;padding: 10px;">
  <div class="am-u-lg-12">
    <div class="form-group">
   

  {{ Form::textarea('content', Input::old('content'), array('rows' => '15',  'class' => 'form-control', 'placeholder' => '文章内容', 'id'=>'inputcontent'  ) ) }}
    </div>
 </div>
       
 </div> 

   
 <div class="am-g  form-inline" style="margin: 10px;padding: 10px;">
<div class="am-u-sm-3 am-u-sm-centered">
      <button type="submit" class="btn btn-primary btn-lg"> 发表 </button>

      
 {{ Form::token() }}

{{ Form::close() }}
    </div>
       
 </div> 


   
   </div> 
    </div> 


  <!-- /form>-->
@stop