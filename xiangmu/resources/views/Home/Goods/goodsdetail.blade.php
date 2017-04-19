@extends('Home.index')
        <link href="/homes/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />
		<link href="/homes/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
@section('content')
       
	<div class="single">
		<div class="container">
			<div class="single-grids">				
				<div class="col-md-4 single-grid">		
					<div class="flexslider">
						<ul class="slides">
						@foreach($pic as $v)
							<li data-thumb="/goods/{{$v->pic}}">
								<div class="thumb-image"> <img src="/goods/{{$v->pic}}" data-imagezoom="true" class="img-responsive"> 
								</div>
							</li>
						@endforeach	
						</ul>
					</div>
				</div>	
				<div class="col-md-4 single-grid simpleCart_shelfItem">		
					<h3>商品名：{{$goods->goodsname}}</h3>
					<p> 介绍：{{$goods->goodstitle}}</p>
					<div style="display:none" class="hid">{{$goods->id}}</div>
					<div style="display:none" class="hi">{{$goods->s_id}}</div>
					<ul class="size">
						<h3>发布者</h3>
							<li><a href="/Home/User/user?id={{$user->id}}" class='user'>{{$user->username}}</a></li>
					</ul>
					<ul class="size">
						<h3>所属鱼塘</h3>
							<li>
							@if(isset($fish))
								<a href="/Home/Fish/detail?id={{$fish->id}}">{{$fish->t_name}}</a>
							@else
								未通过鱼塘发布
							@endif		
							</li>
					</ul>
					<div class="galry">
						<div class="prices">
							<h5 class="item_price">${{$goods->price}}</h5>
						</div>
						<div class="rating">
							<span>☆</span>
							<span>☆</span>
							<span>☆</span>
							<span>☆</span>
							<span>☆</span>
						</div>
						<div class="clearfix"></div>
					</div>
					<!-- 交易按钮  开始 -->
						<div class="btn_form">
							<a href="xuanzedizhiye?goods_id={{$goods->id}}" class="add-cart item_add">我要交易</a>	
						</div>
					<!-- 交易按钮  结束 -->
					
					<!-- 点赞按钮  开始 -->
						<div class="btn_form" id="shifoudianzan" >
						<a href="javascript:void(0)" class="add-cart item_add" id="woyaodianzan" >
						@if($res==1)
						取消
						@else
						点赞
						@endif
						</a>		
							<span>已经有<span id="dianzanshuliang">{{$dianzan}}</span>人点赞</span>
							<input type="hidden" name="shangpinid" value="{{$goods->id}}">
						</div>
					<!-- 点赞按钮   结束 -->
					
				</div>
				<div class="clearfix"></div>
					<!-- 分享 开始 -->
							 <!-- JiaThis Button BEGIN  -->
								<!-- <div> -->
									<!-- <div class="jiathis_style"> -->
										<!-- <a class="jiathis_button_qzone"></a> -->
										<!-- <a class="jiathis_button_tsina"></a> -->
										<!-- <a class="jiathis_button_tqq"></a> -->
										<!-- <a class="jiathis_button_weixin"></a> -->
										<!-- <a class="jiathis_button_renren"></a> -->
										<!-- <a class="jiathis_button_xiaoyou"></a> -->
										<!-- <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a> -->
										<!-- <a class="jiathis_counter_style"></a> -->
									<!-- </div> -->
								<!-- </div> -->
							    <!-- // <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script> -->
							 <!-- JiaThis Button END  -->
					<!-- 分享 结束 --> 
				
			</div>
		</div>
	</div>
<!-- 点赞的js操作 开始 -->
	<script type="text/javascript">
		$('.user').click(function(){
			// 判断是否登录
				@if(!session()->has('qid'))
				alert('请先去登陆');
				return false;
				@endif
		})
	
		var aaa = $('#woyaodianzan').text().replace(/(^\s*)|(\s*$)/g, ""); 
	  
		var pid = $('input[name=shangpinid]').val();
		
		// 点赞按钮的ajax操作 开始

			$('#woyaodianzan').click(function()
			{
				// 判断是否登录
					@if(!session()->has('qid'))
					alert('请先去登陆');
					return false;
					@endif
				// 发送ajax
					$.ajaxSetup({
			            headers: {
			                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			         	   }
			    		});		
					if (aaa == "点赞")
					{
					 
				 		$.ajax({
				 			url:'/Home/Goods/dianzanshu',
				 			type:'post',
				 			data:{id:pid},
				 			success:function(data){
				 				$('#dianzanshuliang').html(data); 
				 				$('#woyaodianzan').html('取消');
				 				aaa='取消';
				 			},
				 		});
				
				 	}else if(aaa == '取消')
				 	{
				 	
					  	$.ajax({
					 		url:'/Home/Goods/quxiaodianzan',
					 		type:'post',
					 		data:{id:pid},
					 		success:function(data){
					 		
						 		$('#dianzanshuliang').html(data); 
						 		$('#woyaodianzan').html('点赞');
						 		aaa='点赞';
					 		},
				 	
				 		});
						return false;	
					} 	
			})
		// 点赞按钮的ajax操作 结束

	</script>
<!-- 点赞的js操作 开始 -->

	<div class="collpse tabs">
		<div class="container">
			<div class="panel-group collpse" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							 留言信息
							</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
						<button type="button" class="btn btn-info liuyan">留言</button>
						<!-- 留言表单 隐藏的 开始-->
							<form action="#" method="post" style="display:none" class="form">
								<textarea class="form-control con" rows="3" required="required"></textarea><br/>
							 	<button type="button" class="btn btn-info send">发表</button>	
							</form>
						<!-- 留言表单 隐藏的 结束-->
                 				<ul class="am-comments-list am-comments-list-flip big">
                 				@foreach($talk as $v)
                 					<div class="formscheck">
									<!-- 评论容器显示的  开始-->	
										<li class="am-comment">
											
												<img class="am-comment-avatar" src="/uploads/{{$v->upic}}" />
												<!-- 评论者头像 -->
											
											<div class="am-comment-main">
												<!-- 评论内容容器 -->
												<header class="am-comment-hd">
													<!--<h3 class="am-comment-title">评论标题</h3>-->
													<div class="am-comment-meta">
														<!-- 评论元数据 -->
														@if($v->fatherid)
															{{$v->uname}}评论{{$v->funame}}
															回复于
														@else
															<a href="#link-to-user" class="am-comment-author">{{$v->uname}}</a>
														
														<!-- 评论者 -->
														评论于
														@endif
														<time datetime="">{{date('Y-m-d h:i:s',$v->rtime)}}</time>
														<!-- 该条评论的ID -->
														<div style="display:none" class="talk_id">{{$v->id}}</div>
													</div>
												</header>

												<div class="am-comment-bd">
													<div class="tb-rev-item " data-id="258040417670">
														<div class="J_TbcRate_ReviewContent tb-tbcr-content">
															{{$v->content}}
														</div>
														@if($v->fatherid)
														@else

														<button type="button" class="btn btn-info reply">回复</button>
														@endif
													</div>
												</div>
												<!-- 评论内容 -->
											</div>
										</li>
									<!-- 评论容器显示的  结束-->

									<!-- 回复表单  开始-->
										<br>
										<form action="/Home/Talk/talk" method="post" style="display:none" class="replyform">
											<textarea class="form-control" rows="3"></textarea><br/>
										 	<button type="button" class="btn btn-info  reply_">回复</button>	
										</form>
									<!--  回复表单  结束-->
									</div>
                 				@endforeach		
								<!-- 评论容器隐藏的  开始-->	
									<li class="am-comment" style="display:none" id="li">
										<a href="">
											<img class="am-comment-avatar" src="#" />
											<!-- 评论者头像 -->
										</a>
										<div class="am-comment-main">
											<!-- 评论内容容器 -->
											<header class="am-comment-hd">
												<!--<h3 class="am-comment-title">评论标题</h3>-->
												<div class="am-comment-meta">
													<!-- 评论元数据 -->
													<a href="#link-to-user" class="am-comment-author uname">h***n (匿名)</a>
													<!-- 评论者 -->
													评论于
													<time datetime="" class="time">2015年11月25日 12:48</time>
												</div>
											</header>

											<div class="am-comment-bd">
												<div class="tb-rev-item " data-id="258040417670">
													<div class="J_TbcRate_ReviewContent tb-tbcr-content  con">
														式样不错，初冬穿
													</div>
													<button type="button" class="btn btn-info liuyan">回复</button>
												</div>
											</div>
											<!-- 评论内容 -->
										</div>
									</li>
								<!-- 评论容器隐藏的  结束 -->		
							</ul>
							{!! $talk->appends($page)->render() !!}
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
	// 留言按钮的点击事件 开始
		$('.liuyan').click(function()
		{
			@if(session()->has('qid'))
			{
				$(this).hide();
				$('.form').css('display','block');
			}@else
			{
				alert('请登录。。。')
			}
			@endif
		})
	// 留言按钮的点击事件 结束

	// 发表留言的表单提交 开始
		$('.send').click(function()
		{
			// 获取留言内容
				var con=$('.con').val();
				if(!con)
				{
					$('.form').css('display','none');
					$('.liuyan').show();
					return;
				}
			// 获取商品ID 
				var goodid=$('.hid').html();
			$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			});	 
			$.post('/Home/Talk/talk',{con:con,goodid:goodid},function(data){
					var newLi = $('#li').clone();
					//显示
					newLi.css('display','block');
					 $('.big').append(newLi);
					//修改信息
					newLi.find('img').attr('src','/uploads/'+data.upic);
				    newLi.find('.uname').html(data.uname);
				    newLi.find('.con').html(con);
				    newLi.find('.time').html(getLocalTime(data.utime));
				    $('.form').css('display','none');
				    $('.liuyan').show()
			},'json');
		})
	// 发表留言的表单提交 结束

	// 回复的表单展现 开始
		$('.reply').click(function()
		{

			@if(session()->has('qid'))
			{
				var name=$(this).parents('.formscheck').find('a').html();
				$(this).parents('.formscheck').find('.replyform').css('display','block');
				$(this).parents('.formscheck').find('.reply_').html('回复'+name);
				$(this).hide();
			}@else
			{
				alert('请登录。。。')
			}
			@endif
		})
	// 回复的表单展现 结束

	// 回复的表单提交 开始
		$('.reply_').click(function(){
			// 回复内容
				var conten=$(this).siblings('textarea').val();
			// 回复表中父级ID
			    var fatherid=$(this).parents('.formscheck').find('.talk_id').html();
			// 获取商品ID
				var goodsid=$('.hid').html();
				var reply=$(this);				
			//发送ajax 
				$.ajaxSetup({
						        headers: {
							            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						        }
				});	 
				$.post('/Home/Talk/reply',{conten:conten,goodsid:goodsid,fatherid:fatherid},function(data)
				{					
					var replyLi = $('#li').clone();
					//显示
					replyLi.css('display','block');
					reply.parents('.formscheck').find('li').after(replyLi);
					//修改信息
				    replyLi.find('img').attr('src','/uploads/'+data.upic);
				    replyLi.find('.uname').html(data.uname+'评论'+data.funame);
				    replyLi.find('.con').html(conten);
				    replyLi.find('.time').html(getLocalTime(data.rtime));
				    reply.parents('.formscheck').find('.replyform').css('display','none')
			    },'json');
		})
	// 回复的表单提交 结束

	// 格式化时间函数 开始
		function getLocalTime(nS)
		{ 
			return new Date(parseInt(nS) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " "); 
		} 
	// 格式化时间函数 结束
	
	// 我要交易 我要点赞的判断 开始
		$('.add-cart').click(function()
		{
			@if(!session('qid'))
				
				alert('请登录');
				return false;
			@endif
			var id=$('.hi').html();

			@if(session('qid')==$goods->s_id)
			
				alert('这个商品是你发布的');
				return false;
			@endif
				
				

		})
	// 我要交易 我要点赞的判断 结束
	</script>
@endsection
