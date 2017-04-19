<!DOCTYPE html>
<html>
<head>
	{!! \App\Http\Controllers\IndexController::title(); !!}
	<!-- Custom Theme files -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //Custom Theme files -->
		<link href="/homes/css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
		<link href="/homes/css/style.css" type="text/css" rel="stylesheet" media="all">
		<link href="/uploads/5.ico" rel="icon">
	<!-- js -->
		<script src="/homes/js/jquery.min.js"></script>
		<script type="text/javascript" src="/homes/js/bootstrap-3.1.1.min.js"></script>
		<script src="/homes/js/imagezoom.js"></script>
		<script type="text/javascript" src="/homes/lib/My97DatePicker/4.8/WdatePicker.js"></script>
	<!-- //js -->	
	<!-- cart -->
		<script src="/homes/js/simpleCart.min.js"> </script>
		<script defer src="/homes/js/jquery.flexslider.js"></script>
		<link rel="stylesheet" href="/homes/css/flexslider.css" type="text/css" media="screen" />
	<!-- cart -->
</head>
<body>
<a name="5F"></href>
	<!--header 开始-->
		<div class="header">
			<div class="container">
				<nav class="navbar navbar-default" role="navigation">
					{!! \App\Http\Controllers\IndexController::logo(); !!}
					<!--navbar-header-->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
						<!-- 所有发布分类 开始 -->
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">精品发布<b class="caret"></b></a>
								{!! \App\Http\Controllers\IndexController::headshow(); !!}
							</li>
						<!-- 所有发布分类 结束 -->
						<!--拍卖分类 开始  -->	
						   <li class="dropdown grid">
								<a href="#" class="dropdown-toggle list1" data-toggle="dropdown">拍卖<b class="caret"></b></a>
								{!! \App\Http\Controllers\IndexController::headpaimai(); !!}
							</li>
						<!--拍卖分类 结束 -->	
						<!--鱼塘分类 开始  -->
							<li class="dropdown grid">
								<a href="#" class="dropdown-toggle list1" data-toggle="dropdown">精品鱼塘<b class="caret"></b></a>
								{!! \App\Http\Controllers\IndexController::headfish(); !!}
							</li>
						<!--鱼塘分类 结束  -->
						<!-- 我要发布模块 开始 -->
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">我要发布<b class="caret"></b></a>
								<ul class="dropdown-menu multi-column columns-4">
									<div class="row">
										<div class="col-sm-3">
											<ul class="multi-column-dropdown">
												<li><a class="list fabu" href="/Home/Auction/auction"><h4>发布拍卖</h4></a></li>
												<li><a class="list fabu" href="/Home/Goods/show"><h4>发布宝贝</h4></a></li>
											</ul>
										</div>																		
									</div>
								</ul>
							</li>
						<!-- 我要发布模块 结束 -->
						</ul> 
						<!--/.navbar-collapse-->
					</div>
					<!--//navbar-header-->
				</nav>
				<div class="header-info">
					{!! \App\Http\Controllers\IndexController::tongzhi(); !!}
					<!--判断是否登录成功   -->
					@if(session()->has('qid'))
						{!! \App\Http\Controllers\IndexController::login(); !!}
					@else
					<!--如果未登录   -->
					<div class="header-right login">
						<a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
						<div id="loginBox">                
							<form id="loginForm" action="/Home/User/login" method="post">
								<fieldset id="body">
									<fieldset>
										<label for="username">用户名</label>
										<input type="text" name="username" id="username" required="required">
										 {{ csrf_field() }}
									</fieldset>
									<fieldset>
										<label for="password">密码</label>
										<input type="password" name="password" id="password" required="required">
									</fieldset>
									<input type="submit" id="login" value="登录">
									<label for="checkbox"><input type="checkbox" id="checkbox"></label>
								</fieldset>
								<p><a class="sign" href="/Home/Retrieve/retrieve">忘记密码</a>　
								<a class="sign" href="/Home/User/register">前去注册</a></p>
							</form>
						</div>
					</div>
					@endif
					<div class="header-right cart">

						<span style="font-size:25px;">
							<!-- 判断是否为塘主身份 开始 -->
	                        @if(session('qauth')==2)
	                            <a href="/Home/Fish/index?id={{session('qid')}}" style="color:white;font-size:20px">我的塘</a>
	                            <!-- 判断是否为塘主身份 结束 -->
	                        @else
	                            <a href="" style="color:white" class="btn btn-primary btn-lg" data-toggle="modal"
	                               data-target="#myModal">塘</a>
	                        @endif
						</span>

					</div>
					
					<!-- 模态框 开始 -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  	<div class="modal-dialog">
							    <div class="modal-content">
									<!--判断是否为塘主 是否登录 开始  -->
								    @if(session()->has('qid'))
								        <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									        <h4 class="modal-title" id="myModalLabel">温馨提示</h4>
								        </div>
								        <div class="modal-body">
								        	此处塘主入口！您还不是塘主
								        </div>
								    @else
						      	        <div class="modal-header">
						      		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						      		        <h4 class="modal-title" id="myModalLabel">温馨提示</h4>
						      	        </div>
						      	        <div class="modal-body">
						      	        	更多内容。。。。请登录
						      	        </div>
						      	    @endif    
										<!--判断是否为塘主 是否登录 结束  -->
								      	<div class="modal-footer">
								        	<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
								      	</div>
							    </div><!-- /.modal-content -->
						  	</div><!-- /.modal-dialog -->
						</div>
					<!-- 模态框 结束 -->
					<div class="clearfix" style="color:white">{{session('qname')}} </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	<!--header 结束-->

		<!-- 成功失败提示信息 开始-->
			@if(session('success'))
			        <div class="alert  alert-success" style="text-align:center">
			            {{session('success')}}
			        </div>
			@endif
			@if(session('error'))
			        <div class="alert alert-danger" style="text-align:center">
		                {{session('error')}}
			        </div>
			@endif
		<!-- 成功失败提示信息 结束-->

	<!-- 继承 开始 -->
		@section('content')

		{!! \App\Http\Controllers\IndexController::paimai(); !!}
		<!-- 轮播 -->
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="padding-top:10px">
			  	<!-- Indicators 开始 -->
				  	<ol class="carousel-indicators">
					    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"> </li>
					    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
					    <li data-target="#carousel-example-generic" data-slide-to="2"></li> 
				  	</ol>
					{!! \App\Http\Controllers\IndexController::lunbo(); !!}
			  	<!-- Indicators 结束 -->

			  	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			  	</a>

			  	<!-- Controls 开始 -->
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				    	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				    	<span class="sr-only">Previous</span>
				  	</a>
			  	<!-- Controls 结束 -->

				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			  	</a>
			  	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			    	<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    	<span class="sr-only">Next</span>
			  	</a>
			</div>
		<!-- 轮播结束 -->
			
		<!--  -->


	   
		<!--gallery-->
			<div class="gallery">
				<div class="container">
					<div class="gallery-grids">
						<!-- 小标题 -->
							<div class="header" style="margin-bottom:10px">
								<div class="container">
									<nav class="navbar navbar-default" role="navigation">
										<div class="navbar-header">
											<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
												<span class="sr-only">Toggle navigation</span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
											</button>
											<h1 class="navbar-brand"><a  href="index.html">精品鱼塘</a></h1>
										</div>
									</nav>
										
									<div class="clearfix"> </div>
								</div>
								<div class="clearfix"> </div>
							</div>	
						<!-- 小标题结束吧 -->
					</div>
		        	<hr class="featurette-divider">

			     	{!! \App\Http\Controllers\IndexController::jingpinyutang(); !!}

					<hr class="featurette-divider">
					<!--最新发布 开始  -->
						<div class="header" style="margin-top:10px">
							<div class="container">
								<nav class="navbar navbar-default" role="navigation">
									<div class="navbar-header">
										<h1 class="navbar-brand"><a  href="#">最新发布</a></h1>	
									</div>
								</nav>	
							</div>		
						</div>
						{!! \App\Http\Controllers\IndexController::zuijinfabu(); !!}
					<!--最新发布 结束  -->	
					<hr class="featurette-divider">
				</div>
			</div>
		<!--//gallery-->
		<!-- 广告 -->
			{!! \App\Http\Controllers\IndexController::guanggao(); !!}   
		<!-- 广告结束 -->
		<!-- 商品搜索 -->
		<div class="subscribe">
			<div class="container">
				<h3>商品搜索</h3>
				<form action="/Home/Sousuo/index" method="get">
					<input type="text" class="text" name="title" placeholder="搜索" required="required">
					<input type="submit" value="搜索">
				</form>
			</div>
		</div>

		<!--//subscribe-->
		@show

	<!-- 继承 结束  -->
	
		{!! \App\Http\Controllers\IndexController::huodong(); !!}
	<!--footer-->
		{!! \App\Http\Controllers\IndexController::footer(); !!}
		<div style="width:100px;height:50px;background:white;float:right;margin-right:20px; text-align:center;line-height:50px;opacity: 0.5;border-radius: 15px;">
				<a href="#5F"><string style="font-size:30px;">⇑</string>回到顶部</a>
		</div>
	<!--//footer-->
	
	{!! \App\Http\Controllers\IndexController::config(); !!}
	
		<script type="text/javascript">
			// <!-- 提示信息定时关闭 开始 -->
				$(function(){
				   setTimeout(function(){
				     $('.alert-success').hide();
				     $('.alert-danger').hide();
				   },2000)
				})
			// <!-- 提示信息定时关闭 结束 -->
			
			$(window).load(function() {
				$('.flexslider').flexslider({
					animation: "slide",
					controlNav: "thumbnails"
				});
				//发布商品时判断是否登录 开始 
					$('.fabu').click(function()
					{
						@if(!session()->has('qid'))
						
							alert('您还未登录。。。');
							return false;
						@endif			
					})
				//发布商品时判断是否登录 结束

				//查看消息时判断是否登录 开始 
					$('.message').click(function()
					{
						@if(!session()->has('qid'))
						
							alert('您还未登录。。。');
							return false;
						@endif			
					})
				//查看消息时判断是否登录 结束
			});
		</script>

</body>
</html>