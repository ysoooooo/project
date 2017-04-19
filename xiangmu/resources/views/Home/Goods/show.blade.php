@extends('Home.index')
@section('content')
<style>
        * { margin: 0; padding: 0; }

		#bg { position: absolute; top: 1; left: 0; }
		.bgwidth { width: 100%; }
		.bgheight { height: 100%; }
        .row { 
            width: 700px;
            margin: 15px auto;
            padding: 0px;
            background: ;
            opacity: 0.8;
            box-shadow: 0 0 20px black;
        }
        .row1 { 
            width: 800px;
            margin: 23px auto;
            padding: 15px;
            background: #A78093;
            opacity: 0.4;
            font-weight:bold;
            color:#354E37;
            box-shadow: 0 0 20px black;
        }
        /*.footer-grid{ 
            width: 25px;
            padding: 60px;
            background: #DC9981;
            opacity: 0.4;
            -moz-box-shadow: 0 0 210px black; 
            -webkit-box-shadow: 0 0 210px black; 
            box-shadow: 0 0 20px black;
        }*/
        .footer-bottom{ position: absolute; top: 1; left: 0;width: 100%; }
        p { font-weight:bold; color:white;font: 30px/1.8 Georgia, Serif; margin: 0 0 9px 0; text-indent: -20px;height: 100%; }
    </style>
<img src="/homes/images/2 (3).jpg" id="bg">

    <ol class="row1">
        <h3>宝贝发布</h3>
    </ol>

<div class="row">
	<div class="col-xs-6 col-md-2"></div>
	<!-- 发布的表单 开始 -->
		<div class="col-xs-2 col-md-8">
		  	<form role="form" action="/Home/Goods/insert" method="post" enctype="multipart/form-data">
		  	    <div class="form-group">
		  	    	<label for="exampleInputEmail1">商品名称:</label>
		  	    	{{ csrf_field() }}
		  	    	<input type="text" class="form-control" id="exampleInputEmail1" required="required" name="goodsname">
		  	    </div>
		  	    <div class="form-group">
			  	    <label for="exampleInputPassword1">商品价格:</label>
			  	    <input type="text" class="form-control" id="exampleInputPassword1" required="required" name="price">
		  	    </div>
		  	    <div class="form-group">
			  	    <label for="exampleInputFile">图片简介:</label>
			  	    <input type="file" id="exampleInputFile" multiple name="pic[]">
		  	    	<span class="help-block">上传图片不要超过四张</span>
		  	    </div>
		  	    	<label for="exampleInputFile">商品分类:</label>
		  	    <select class="form-control" required="required" name="P_id">
		  	    	@if(isset($p_name))
		  	    		<option value="{{$p_id}}">{{$p_name}}</option>
		  	    	@else
			  	    	@foreach($cate as $v)
				  	    	<option name="P_id" value="{{$v->id}}">{{$v->name}}</option>
				  	    @endforeach
				  	@endif    
		  	    </select>
	      	    <div class="form-group">
	    	  	    <label for="exampleInputPassword1">商品简介:</label>
	    	  	    <input type="textarea" class="form-control" id="exampleInputPassword1" required="required" name="goodstitle">
	      	    	<input type="hidden" name="s_id" value="{{session('qid')}}">
	      	    	<input type="hidden" name="created_at" value="{{time()}}">
	      	    	@if(isset($t_id))
	      	    		<input type="hidden" name="t_id" value="{{$t_id}}">
	      	    	@endif	
	      	    </div>
		  	    <br><br>		
		  	    <button type="submit" class="btn btn-default">发布</button>
		  	</form>
		</div>
	<!-- 发布的表单 结束 -->
</div>
<script>
	$(window).load(function() {
	    var theWindow = $(window);
	    var $bg = $('#bg');
	    var aspectRatio = $bg.width() / $bg.height();

	    function resizeBg() {
	        if(theWindow.width() / theWindow.height() < aspectRatio) {
	            $bg
	                .removeClass()
	                .addClass('bgheight');
	        } else {
	            $bg
	                .removeClass()
	                .addClass('bgwidth');
	        }
	    }

	    theWindow.resize(resizeBg).trigger('resize');
	});
</script>


@endsection