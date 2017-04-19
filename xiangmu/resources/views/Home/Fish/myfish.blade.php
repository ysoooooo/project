@extends('Home.index')
@section('content')
<ol class="breadcrumb">
  <li style="font-size:30px">我的鱼塘</li>
   <li>{{$cate->name}}</li>
   <li>{{$arr->t_name}}</li>
</ol>
<div class="container">
      	<div class="jumbotron">
      		<!-- 鱼塘的大幕 -->
        	    <img src="/fish/{{$arr->t_bac}}" alt="" width="1000px" height="350px">
        	<!-- 塘主的信息 开始-->
		    	<ul class="media-list" style="margin-top:10px">
		      		<li class="media">
		        		<a class="pull-left" href="#">	
		          			<img class="media-object" src="/fish/{{$arr->t_pic}}" alt="..." width="100px">
		        		</a>
			            <div class="media-body">
			                <h3 class="media-heading">
				                {{$arr->t_name}} 
				                <a href="/Home/Control/change?id={{$arr->id}}" style="color:white">　　 
					                <button type="button" class="btn btn-success">
		            					更改鱼塘配置
		            	    		</button>
	            	    		</a>　
			                </h3>
			                <h4 class="media-heading num" sid="{{$arr->id}}">发布总数：0</h4>
			                 <h4 class="media-heading">鱼塘成员数：{{$member}}</h4>
			                <h4 class="media-heading">介绍：{{$arr->t_title}}</h4>
			            </div>
			            <a href="/Home/Goods/show?t_id={{$arr->id}}&p_name={{$cate->name}}" style="color:white">
				            <button type="button" class="btn btn-success">
		            			发布商品
		            	    </button>
	            	    </a>
		      		</li>
		    	</ul>
        	<!-- 塘主的信息 结束-->
      	</div>
      	<!-- 发布的商品的具体内容 开始 -->
      	@if(isset($goods))
	      	@foreach($goods as $v)
				<div class="panel panel-warning" style="background:pink;height:600px">
					<div class="panel-body">
			        	<ul class="media-list">
			          		<li class="media">
			            		<a class="pull-left user" href="/Home/User/user?id={{$v->aa}}">
			              			<img src="/uploads/{{$v->pic}}" alt="没找到" class="img-circle" width="50px">
			            		</a>
					            <div class="media-body">

					              <h3 class="media-heading">
									@if($v->aa==$arr->tz_id)
										塘主发布
					              	@else
					              		{{$v->username}}　
					              	<a href="/Home/Control/outuser?id={{$v->s_id}}&fish_id={{$arr->id}}" style="color:white">	　　　　
										<button type="button" class="btn btn-danger">
										此用户踢出鱼塘									
										</button>
									</a>
	 
									@endif			
					              </h3>
					              <h4 class="media-heading">发布于{{date('Y-m-d',$v->created_at)}}</h4>
					            </div>
			          		</li>
			        	</ul>
					</div>
					<div>
			             <p><a href="/Home/Goods/detail?id={{$v->id}}"><button type="button" class="btn btn-success">商品名称：{{$v->goodsname}}</button></a> 　
			            　 <button type="button" class="btn btn-warning">商品价格:{{$v->price}} 元</button></p>
			            <p style="float:left">
						@foreach($v->pic_arr as $k=>$vv)
							
			              	<img src="/goods/{{$vv->pic}}" alt="好像飞走了" class="img-rounded" style="margin-left:15px">
			              	
			            @endforeach  	
			            </p>
		            </div>
		            <nav class="navbar navbar-default" role="navigation">
						<p> <button type="button" class="btn btn-success">商品简介</button>：{{$v->goodstitle}}</p>
						<br/>
						@if($v->aa==$arr->tz_id)
						@else
						<a href="/Home/Control/out?id={{$v->id}}" style="color:white">
							<button type="button" class="btn btn-danger">
								此商品踢出鱼塘
							</button> 
						</a>
						@endif		
					</nav>
				</div>
				
				<hr>
			@endforeach	
		@endif	
      	<!-- 发布的商品的具体内容 结束 -->
      	<script>
      		// 进入用户个人中心判断 开始
				$('.user').click(function()
				{
					@if(!session()->has('qid'))
						alert('您还未登录。。。');
						return false;
					@endif	
				})
			// 进入用户个人中心判断 结束

      		// 鱼塘的发布条数 开始
				$(function()
				{ 
					var num=$('.num').attr('sid');
			　　　　$.ajaxSetup({
					        headers: {
						        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					        }
					});	 
					$.post('/Home/Fish/num',{num:num},function(data)
					{					
						if(data)
						{
							$('.num').html('发布总数：'+data);
						}else
						{
							$('.num').html('发布总数：0');
						}
				    },'json');
			　　}); 
			// 鱼塘的发布条数 结束
      	</script>
</div>
@endsection
