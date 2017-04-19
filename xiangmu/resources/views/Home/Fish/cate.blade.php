@extends('Home.index')
@section('content')
<ol class="breadcrumb">
  <li style="font-size:30px">鱼塘</li>
   <li>{{$pname}}</li>
   <li>{{$name}}</li>
</ol>
<div class="container">
	<div class="product-model-sec single-product-grids">
	<!-- 鱼塘的背景简介 开始 -->
	@foreach($arr as $v)
		<div class="product-grid single-product">
		<!-- 详情入口 路由地址 -->
			<a href="/Home/Fish/detail?id={{$v->id}}&pname={{$pname}}&name={{$name}}">
			<div class="more-product"><span> </span></div>						
			<div class="product-img b-link-stripe b-animate-go  thickbox">
				<img src="/fish/{{$v->t_pic}}" alt="好像没有" width="100%">
			<div class="b-wrapper">
				<h4 class="b-animate b-from-left  b-delay03">							
				<button>进入</button>
				</h4>
				</div>
			</div>
			</a>					
			<div class="product-info simpleCart_shelfItem">
				<div class="product-info-cust prt_name">
					<h4>鱼塘：{{$v->t_name}}</h4>								
					<span class="item_price num" sid="{{$v->id}}">商品发布数：0</span>
					<span class="item_price">简介：{{$v->t_title}}</span>
					<div class="clearfix"> </div>
				</div>												
			</div>
		</div>
	@endforeach	
	<!-- 鱼塘的背景简介 结束 -->	
		<div class="clearfix"> </div>
	</div>
</div>
<script>
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
							$('.num').html('商品发布数：'+data);
						}else
						{
							$('.num').html('商品发布数：0');
						}
				    },'json');
			　　}); 
		// 鱼塘的发布条数 结束
</script>
@endsection