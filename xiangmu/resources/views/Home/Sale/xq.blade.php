@extends('Home.index')
       
@section('content')
 <h1>拍卖详情</h1>      
	<div class="single">
		<div class="container">
			<div class="single-grids">				
				<div class="col-md-4 single-grid">		
					<div class="flexslider">
						<ul class="slides">
						@foreach($pic as $v)
							<li data-thumb="/sale/{{$v->pic}}">
								<div class="thumb-image"> <img src="/sale/{{$v->pic}}" data-imagezoom="true" class="img-responsive"> 
								</div>
							</li>
						@endforeach	
						</ul>
					</div>
				</div>	
				<div class="col-md-4 single-grid simpleCart_shelfItem">		
					<h3>拍卖商品名：{{$data->title}}</h3>
					<p></p>
					<ul class="size">
						<h3>发布者</h3>
							<li><a href="/Home/User/user?id={{$user->id}}">{{$user->username}}</a></li>
					</ul>
					<ul class="size">
						<h3>拍卖介绍</h3>
							<li>{{$data->keyword}}</li>
					</ul>
					<div class="galry">
						<div class="prices">
							<h5 class="item_price"></h5>
						</div>
						<div class="rating">
							<span>☆</span>
							<span>☆</span>
							<span>☆</span>
							<span>☆</span>
							<span>☆</span>
						</div>
						<div class="clearfix">
						
						</div>
						 <h3>当前最高价格：　
							 <span class="max">
							 	@if(isset($res))
							 		{{$res->price}}
							 	@else
							 		{{$data->dprice}}
							 	@endif	
							 </span> 元
						 </h3>
					</div>
					<h3> 距离拍卖结束 </h3>
					<h3 class="jieshu">
						<span class="t_d">00天</span>
	                    <span class="t_h">00时</span>
	                    <span class="t_m">00分</span>
	                    <span class="t_s">00秒</span>
					</h3>
					<div class="btn_form">
						<a href="#" class="add-cart item_add chujia">我要出价</a>
						<form action="/Home/Auction/jingjia" method="post" style="display:none" class="jiajia">
							<input type="text" name="price" class="price">
							{{ csrf_field() }}
							<br><br>
							<button type="submit" class="btn btn-success send">出价</button>
						</form>	
					</div>
					<div class="btn_form">
						
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	    <div style="display:none" class="ltime">
                    {{$data->ltime}}
        </div>
        <div style="display:none" class="pid">
                    {{$data->id}}
        </div>
<script>
	
	var ltime = $('.ltime').html();
	//2017-03-31 15:56:41 
	var reg = /-/g;
	var lres = ltime.replace(reg,'/');
	s = 0;
	m = 0;
	h = 0;
	d = 0;
	var GetRTime = setInterval(function(){
	   var EndTime = new Date(lres);
	   var NowTime = new Date();
	   var t =EndTime.getTime() -NowTime.getTime();
	   // 如果拍卖结束
	   if(t<=0)
	   {
	   		clearInterval(GetRTime);
	   		$('.jieshu').html('拍卖已结束');
	   		$('.dianzan').attr('href','javascript:return false;');
	   		$('.chujia').attr('href','javascript:return false;');
	   		$('.chujia').unbind('click');
	   		// 发送ajax 查询价高者，发送通知
	   		var pid=parseInt($('.pid').html());
	   		$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});	 
			$.post('/Home/Auction/chengjiao',{pid:pid},function(data){
					if(data)
					{
						alert('拍卖结束'); 
					}                     
					
			},'json');
	   }else
	   {
	   		var d=Math.floor(t/1000/60/60/24);
		    var h=Math.floor(t/1000/60/60%24);
		    var m=Math.floor(t/1000/60%60);
		    var s=Math.floor(t/1000%60);

		    $('.t_d').html(d + "天");
		    $('.t_h').html(h + "时");
		    $('.t_m').html(m + "分");
		    $('.t_s').html(s + "秒");
	   }
	   
	},0);

	$('.chujia').click(function()
	{

		@if(session('qid')==$data->uid)
			alert('这个商品是你发布的！');
			return false;
		@endif

		@if(session('qid'))
			$(this).css('display','none');
			$('.jiajia').css('display','block');
		@else
			alert('您还未登录！');
			return false;
		@endif
		
	})	
	$('.send').click(function(){
		// 获取加价的值
			var price=$('.price').val();
			var pid=$('.pid').html();
			var pid=parseInt(pid);
			var max=$('.max').html();
			if(!price)
			{
				$('.jiajia').css('display','none');
				$('.chujia').show();
				return false;	
			}
			if(parseInt(price) <= parseInt(max))
			{
				$('.jiajia').css('display','none');
				$('.chujia').show();
				alert('您出的价格不合适');
				return false;
			}
		// 发送ajax
			$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			});	 
			$.post('/Home/Auction/jingjia',{price:price,pid:pid},function(data){
					if(data)
					{
						$('.max').html(data);
						$('.jiajia').css('display','none');
						$('.chujia').show();
						alert('出价成功');
					}                                            
					
			},'json');
		    return false; 
	})
</script>
@endsection	

