@extends('Home.index')
@section('content')
<ol class="breadcrumb">
   <li style="font-size:30px">鱼塘</li>
   @if(isset($all['pname']))
	   <li>{{$all['pname']}}</li>
	   <li>{{$all['name']}}</li>
   @else
	
   @endif
</ol>
<div class="container">
      	<div class="jumbotron">
      		<!-- 鱼塘的大幕 -->
        	    <img src="/fish/{{$fish->t_bac}}" alt="" width="1000px" height="350px">
        	<!-- 塘主的信息 开始-->
		    	<ul class="media-list" style="margin-top:10px">
		      		<li class="media">
		        		<a class="pull-left" href="#">	
		          			<img class="media-object" src="/fish/{{$fish->t_pic}}" alt="..." width="100px">
		        		</a>
			            <div class="media-body">
			                <h3 class="media-heading">
				                {{$fish->t_name}} 　　　　此鱼塘塘主：
				                @if($tz_name)
				                	{{$tz_name}}
								@else
									<a href="/Home/Fish/shenqing?user_id={{session('qid')}}& fish_id={{$fish->id}}&
									fish_name={{$fish->t_name}}& user_name={{session('qname')}}" 
									id="shenqing">
									暂无塘主！前去申请
									</a>
								@endif
			                </h3>
			                <h4 class="media-heading num" sid="{{$fish->id}}">发布总数：0</h4>
			                <h4 class="media-heading">鱼塘成员数：{{$member}}</h4>
			                <h4 class="media-heading">简介：{{$fish->t_title}}</h4>
			            </div>
			            	@if(isset($num))
			            		<a href="/Home/Goods/show?t_id={{$num->fish_id}}&p_name={{$cate->name}}" style="text_decoration:none">
					            	<button type="button" class="btn btn-success">发布商品</button>
			            	  	</a>
			            	@else 
			            	<a href="/Home/Fish/join?uid={{session('qid')}}&fid={{$fish->id}}" style="text_decoration:none">  	
					            <button type="button" class="btn btn-success join">加入鱼塘</button>
				            </a>
				            @endif
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
					              @if($v->username==$tz_name)
					              塘主
					              @else
					              {{$v->username}}
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
					</nav>
				</div>
				
				<hr>
			@endforeach
		@endif		
      	<!-- 发布的商品的具体内容 结束 -->      	
</div>
<!-- 加入鱼塘判断是否登录 -->
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

		// 加入鱼塘的判断 开始
			$('.join').click(function()
			{
				@if(!session()->has('qid'))
					alert('您还未登录。。。');
					return false;
				@endif	
			})
		// 加入鱼塘的判断 结束

		// 申请鱼塘塘主的判断 开始
			$('#shenqing').click(function()
			{
				@if(!session()->has('qid'))
					alert('您还未登录。。。');
					return false;
				@endif
				if($('.join').html()=='加入鱼塘')
				{
					alert('您还未加入此鱼塘。。。');
					return false;
				}
								
			})
		// 申请鱼塘塘主的判断 结束

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
<!-- 加入鱼塘判断是否登录 -->
@endsection