@extends('Home.index')

@section('content')
	<ol class="breadcrumb">
   		<li style="font-size:30px">我的鱼塘个性化</li>  
    </ol>
    <div class="row">
	    <div class="col-md-4"></div>
	    <div class="col-md-4">
	    	<form role="form" method="post" action="/Home/Control/update" enctype="multipart/form-data">
	    	  
                <div class="form-group">
                    <label class="control-label">鱼塘名称:</label>
                    <input class="form-control"name="t_name"type="text" value="{{$data->t_name}}" required="required" class="form-control" value="{{old('name')}}">  
                </div>
				<input type="hidden" name="id" value="{{$data->id}}">
                <div class="form-group">
                    <label>鱼塘logo：</label>
                    <img src="/fish/{{$data->t_pic}}" alt="" style="width:200px;">
                    <input type="hidden" name="old_t_pic" value="{{$data->t_pic}}">
                    <input type="file" name="t_pic">
                </div>

                <div class="form-group">
                    <label>鱼塘背景：</label>
                    <img src="/fish/{{$data->t_bac}}" alt="" style="width:200px;">
                    <input type="hidden" name="old_t_bac" value="{{$data->t_bac}}">
                    <input type="file" name="t_bac">
                </div>

                 <div class="form-group">
                    <label class="control-label">鱼塘介绍:</label>
                    <input class="form-control"name="t_title"type="text" value="{{$data->t_title}}" required="required" class="form-control" value="{{old('name')}}">  
                </div>

                    {{ csrf_field() }}

                <button type="submit" class="btn btn-default">编辑</button>
               
	    	</form>
	    	<br/>
	    </div>
	    <div class="col-md-4">   </div>
	</div>
@endsection