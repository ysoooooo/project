@extends('Home.index')
@section('content')

	<hr>
<div class="row featurette" style="background:url('/uploads/2.jpg');margin-bottom:100px">	
    <div class="col-md-2 col-md-offset-2">
      <h2 class="featurette-heading">欢迎您. </h2>
      <h3><span class="text-muted">　　{{session('qname')}}</span></h3>
      <h4>称号:{{$inter->integral}}</h4>
      <p class="lead">粉丝数：{{$number}}</p>
    </div>
	<div style="margin-bottom:100px">
		<div class="col-md-8 col-md-offset-2 data-toggle="modal"" data-toggle="modal" data-target="#Myxiugai">	 
			<button type="button" class="btn btn-default btn-lg btn-block" style="background:url('/uploads/1.jpg')">修改密码</button>
		</div>
		<div class="col-md-8 col-md-offset-2 data-toggle="modal"" data-toggle="modal" data-target="#MyZiliao">	 
			<button type="button" class="btn btn-default btn-lg btn-block" style="background:url('/uploads/1.jpg')">编辑资料</button>
		</div>
		<div class="col-md-8 col-md-offset-2 data-toggle="modal"" data-toggle="modal" data-target="#MyFabu">	 
			<button type="button" class="btn btn-default btn-lg btn-block" style="background:url('/uploads/1.jpg')">我发布的商品</button>
		</div>
	    <div class="col-md-8 col-md-offset-2 data-toggle="modal"" data-toggle="modal" data-target="#Mydingdan">
			<button type="button" class="btn btn-default btn-lg btn-block" style="background:url('/uploads/1.jpg')">我的订单</button>
		</div>
	   
		<div class="col-md-8 col-md-offset-2 data-toggle="modal"" data-toggle="modal" data-target="#MyZan">
			<button type="button" class="btn btn-default btn-lg btn-block" style="background:url('/uploads/1.jpg')">我赞过的商品</button>
		</div>
		<div class="col-md-8 col-md-offset-2 data-toggle="modal"" data-toggle="modal" data-target="#Myguanzhu">
			<button type="button" class="btn btn-default btn-lg btn-block" style="background:url('/uploads/1.jpg')">我关注的人</button>
		</div>
		<div class="col-md-8 col-md-offset-2">
			<a href="/Home/User/mypaimai"><button type="button" class="btn btn-default btn-lg btn-block" style="background:url('/uploads/1.jpg')">我的拍卖</button></a>
		</div>
		<div class="col-md-8 col-md-offset-2 data-toggle="modal"" data-toggle="modal" data-target="#Jointang">
			<button type="button" class="btn btn-default btn-lg btn-block" style="background:url('/uploads/1.jpg')">我加入的鱼塘</button>
		</div>
		<div class="col-md-8 col-md-offset-2">
			<a href="/Home/User/shouhuodizhilist"><button type="button" class="btn btn-default btn-lg btn-block" style="background:url('/uploads/1.jpg')">我的收货地址</button></a>
		</div>
		<div class="col-md-8 col-md-offset-2 data-toggle="modal"" data-toggle="modal" data-target="">
			<a href="/Home/User/tuichu"><button type="button" id="tuichudenglu" class="btn btn-default btn-lg btn-block" style="background:url('/uploads/1.jpg')">退出登录</button></a></div>
	</div>
</div>


<!-- 模态框开始 -->

	<!-- 修改密码  开始-->
		<form action="/Home/User/updpass" id="xiugaimima" method="post" enctype="multipart/form-data">
			<div class="modal fade" id="Myxiugai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">修改密码</h4>
			      </div>
			      <div class="modal-body">
					<div class="bs-example">
						<form role="form">
							<div class="form-group">
								<label for="exampleInputPassword1">原密码</label>
								<input class="form-control"  id="oldpass"  placeholder="请输入您的密码" name="oldpassword" type="text">
								<span></span>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">新密码</label>
								<input class="form-control"  id="exampleInputPassword1"    placeholder="请输入您的新密码" name="password" type="text">
								<span></span>
							</div>
							{{ csrf_field() }} 
							<div class="form-group">
								<label for="exampleInputPassword1">确认密码</label>
								<input class="form-control"  id="exampleInputPassword1"  placeholder="请确认您的密码" name="newsurepassword" type="text">
							    <span></span>
							</div>

						</form>
					</div>
					 </div>
			      <div class="modal-footer" id="aaa">
			        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			        <button type="submit" class="btn btn-primary">确定</button>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- .modal-dialog -->
			</div>
		</form> 
		<!-- 修改密码! 表单验证 开始-->
			<script type="text/javascript">
					var UnewpassisOk = true;
					var UnewsurepassisOk = true;
					// var oldpass = document.getElementById('oldpass');
					$('#oldpass').blur(function(){
						if($(this).val() !=''&& $(this).val().length>=6 && $(this).val().length<=18){
							//发送ajax去验证用户名是否存在
							var inp = $(this);


						 $.ajaxSetup({
				            headers: {
				                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				         	   }
				    		});


							$.ajax({
								url:'/Home/User/yanzheng',
								data:{oldpass:inp.val()},
								type:'post',
								success:function(data){
									if(data == 1){
									inp.parent('div').find('span').html('√').css('color','green');
									UserisOk=true;
								}else{
									inp.parent('div').find('span').html('请正确得输入您的密码').css('color','red');
									UserisOk=false;
									}
								},
								async:false
							})
						}else{
							$(this).parent('div').find('span').html('密码不合法').css('color','red');
							
						}
					})



					$('#xiugaimima').submit(function(){
						//触发所有的丧失焦点事件
						$('input').trigger('blur');
								//检测所有字段是否正确
							if(UnewsurepassisOk && UnewpassisOk ){
								// alert(ok);
								return true;
							}else{
								//阻止默认行为
								return false;
							}
						})

					$('input[type!=reset][type!=submit]').focus(function(){
						//获取提示信息
						var t = $(this).attr('readmin');
						$(this).parents('tr').find('span').html(t).css('color','green');
					})

					$('input[name=password]').blur(function(){
						if($(this).val().length >= 6 ){
							$(this).parent('div').find('span').html('okokok').css('color','green');
							UnewpassisOk = true;		
						}else{
							$(this).parent('div').find('span').html('请输入您的新密码').css('color','red');
							UnewpassisOk =false;
						}
					})

					$('input[name=newsurepassword]').blur(function(){
						if($(this).val() != '' && $(this).val() == $('input[name=password]').val()){
							$(this).parent('div').find('span').html('okokok').css('color','green');
							UnewsurepassisOk = true;		
						}else{
							$(this).parent('div').find('span').html('你的两次输入不一样').css('color','red');
							UnewsurepassisOk =false;
						}
					})
			</script>
		<!-- 修改密码! 表单验证 结束-->
	<!-- 修改密码 结束-->
    
	<!-- 修改资料 开始-->
		<form action="/Home/User/upd" method="post" id="xiugaiziliao" enctype="multipart/form-data">
			<div class="modal fade" id="MyZiliao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">编辑资料</h4>
			      </div>
			      <div class="modal-body">
			       	<!-- 修改资料 表单-->
					<div class="bs-example">
						<form role="form">
							<div class="form-group">
								<label for="exampleInputEmail1">昵称</label>
								<input class="form-control" id="exampleInputEmail1" placeholder="请输入您的昵称"  type="text" name="uname" >
								 <span></span>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">邮箱</label>
								<input class="form-control"  id="exampleInputPassword1" name="email" placeholder="请输入您的邮箱" name="email" type="email">
								 <span></span>
							</div>
						{{ csrf_field() }} 
							<div class="radio">
							  <label>
							  	  <input type="radio" name="sex" id="optionsRadios1" value="1" checked>男　　	
							  </label>
							  <label>
							   	   <input type="radio" name="sex" id="optionsRadios1" value="0" >女
							  </label>
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">常住地址</label>
								<input class="form-control" id="exampleInputEmail1" placeholder="请输入你的常住地址" type="text" name="address" >
							   <span></span>
							</div>

							<div class="form-group">
							    <label for="exampleInputFile">头像上传</label>
							    <input type="file" id="exampleInputFile" name="pic">
							    <p class="help-block">听说你的颜值特别高!.</p>
							</div>
						</form>
					</div>
					 </div>
			      <div class="modal-footer" id="aaa">
			        <input class="form-control" type="hidden" name="id" value="{{$users->id}}">
			        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			        <button type="submit" class="btn btn-primary">确定</button>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</form>
		<!-- form表单验证 修改资料  开始-->
		 	<script type="text/javascript">
			 		var UnameisOk = true;
			 		var UaddressisOk = true;
					$('#xiugaiziliao').submit(function(){
						//触发所有的丧失焦点事件
						$('input').trigger('blur');
								//检测所有字段是否正确
							if(UnameisOk && UaddressisOk){
								// alert(ok);
								return true;
							}else{
								//阻止默认行为
								return false;
							}
						})

					$('input[type!=reset][type!=submit]').focus(function(){
						//获取提示信息
						var t = $(this).attr('readmin');
						$(this).parents('tr').find('span').html(t).css('color','green');
					})

					$('input[name=uname]').blur(function(){
					if($(this).val() != ''){
						$(this).parent('div').find('span').html('okokok').css('color','green');
						UnameisOk = true;		
					}else{
						$(this).parent('div').find('span').html('请输入您的昵称').css('color','red');
						UnameisOk =false;
					}
					})
					$('input[name=email]').blur(function(){
						if($(this).val() != ''){
							$(this).parent('div').find('span').html('okokok').css('color','green');
							UnameisOk = true;		
						}else{
							$(this).parent('div').find('span').html('请输入您的邮箱').css('color','red');
							UnameisOk =false;
						}
					})

					$('input[name=address]').blur(function(){
						if($(this).val() != ''){
							$(this).parent('div').find('span').html('okokok').css('color','green');	
							UnameisOk = true;		
						}else{
							$(this).parent('div').find('span').html('请输入您的收货地址').css('color','red');
							UnameisOk =false;
						}
					})
		 	</script>
		<!-- form表单验证 修改资料  结束-->
	<!-- 修改资料 开始-->
	
	<!-- 我的发布  开始-->
		<div class="modal fade" id="MyFabu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">我的发布商品</h4>
		      </div>
		      <div class="modal-body">
		        <div class="bs-example">
		     @foreach($usersfabu as $k => $v)

		      <table class="table table-hover" border="1">
					<tr >
						<td rowspan='3' width="80px" height="70px" align="center">
							<img src='/goods/{{$usersfabutupian[$k]->pic}}' alt="aaa"  width="80px" height="120px" >
						</td>
						<td style=" width:100 overflow:hidden;text-overflow:ellipsis" >商品名：{{$v->goodsname}}</td>
						<td rowspan='3' width="80px" height="70px" align="center">
							<h5>
								@if($v->b_id == 0)
								<a href="/Home/User/updgoods?id={{$v->id}}"><button type="button" class="btn btn-warning">操作</button></a>　　　　 
							    <a href="/Home/User/delgoods?id={{$v->id}}"><button class="btn btn-danger" type="button">删除</button></a>　　　　
							    <a href="/Home/User/updgoodspic?id={{$v->id}}"><button class="btn btn-info" type="button">图片操作</button></a>
								@else
							
								 <a href="/Home/User/showgoods?id={{$v->id}}"><button class="btn btn-info" type="button">商品查看</button></a>
								@endif
							</h5>
						</td>
					</tr>
					<tr>
						<td style=" width:100 overflow:hidden;text-overflow:ellipsis "  >
							商品简介：{{$v->goodstitle}}
						</td>
					</tr>
					<tr>
						<td>
							商品状态 ：@if($v->b_id == 0)
										未出售　　　　　　<a href="/Home/Goods/detail?id={{$v->id}}">商品评论数：{{$v->reply}}</a>
										@else
										已出售
										@endif
						</td>
					</tr>

		      </table>
		       @endforeach
		    </div>
			

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	<!-- 我的发布  结束 -->

	<!-- 我赞过的商品 开始 -->
		<div class="modal fade" id="MyZan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">我赞过的商品</h4>
		      </div>
		      <div class="modal-body">
		      @foreach($usersdianzan as $k => $v)

		      <table class="table table-hover" border="1">
					<tr >
						<td rowspan='3' width="80px" height="70px" align="center">
							<img src='/goods/{{$usersdianzantupian[$k]->pic}}' alt="aaa"  width="80px" height="115px" >
						</td>
						<td style=" width:100 overflow-x:hidden;overflow-y:hidden">商品名称：{{$v->goodsname}}</td>
						<td rowspan='3' width="80px" height="70px" align="center">
							<h5>
								@if($v->b_id)
								 	已经被买走了！
								@else
									<a href="/Home/Goods/detail?id={{$v->id}}"><button class="btn btn-info" type="button">商品查看</button></a>
								@endif
							</h5>
						</td>
					</tr>
					<tr>
						<td style=" width:100 overflow-x:hidden;overflow-y:hidden"  >商品简介：{{$v->goodstitle}}</td>
					</tr>
					<tr>
						<td>
							商品状态 ：@if($v->b_id == 0)
										未出售
										@else
										已出售
										@endif
						</td>
					</tr>
		      </table>
		       @endforeach
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	<!-- 我赞过的商品 结束 -->
	
	<!-- 我关注的 开始-->
		<div class="modal fade" id="Myguanzhu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">我关注的人</h4>
		      </div>
		      <div class="modal-body">
		        <table class="table table-hover">
		        @foreach($guanzhu as $v)
					<tr >
						<td rowspan='2'><a href="/Home/User/user?id={{$v->b_id}}">{{$v->username}}</a></td>	
					</tr>
				@endforeach	
		      </table>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	<!-- 我关注的 结束-->

	<!-- 我加入的鱼塘 开始-->
		<div class="modal fade" id="Jointang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">我加入的鱼塘</h4>
		      </div>
		      <div class="modal-body">
		        <table class="table table-hover" border="1">
		        	@foreach($res as $v)
						<tr>
							<td>
								<a href="/Home/Fish/detail?id={{$v->fish_id}}">{{$v->t_name}}</a>　　　　　
								@if($v->tz_id==session('qid'))
									　　　　你是塘主
								@else
								<a href="/Home/Fish/tuichu?uid={{session('qid')}}&fid={{$v->fish_id}}"><button type="button" class="btn btn-danger">退出此鱼塘</button></a>
								@endif
							</td>	
						</tr>
					@endforeach
		      </table>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	<!-- 我加入的鱼塘 结束-->

	<!-- 我的订单 开始 -->
		<div class="modal fade" id="Mydingdan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">我的订单</h4>
		      </div>
		      <div class="modal-body">
		    <!--订单选项卡css样式 开始  -->
			      <style type="text/css">
						*{margin: 0;padding: 0;list-style:none;}
						#all{width: 550px;margin: 0 auto; margin-top: 20px;}
						#option{
							height: 38px;line-height:38px;
							border-bottom:1px solid #999;
							border-left:1px solid #999;
						}	
						#option li{
							float: left;padding: 0 28px;
							background: #f5f5f5;
							border-right:1px solid #999;
							border-top:1px solid #999;
							height:37px;cursor:pointer;
						}
						#card{
							border:1px solid #999;border-top:none;
						}
						#card li{
							padding: 20px;display:none;
						}
						#card li.active{
							display:block;
						}

						#option li.active{
							height:38px;
							background: #fff;
						}
					</style>
			<!--订单选项卡css样式 开始  -->		
				<div id="all">
					<ul id="option">
						<li class="active">未发货订单</li>
						<li >已发货订单</li>
						<li >未付款订单</li>
						<li >已完成订单</li>
					</ul>
					<ul id="card">
					<!-- 未发货订单 开始-->
						<li class="active">
						@foreach($datt as $k => $v)
	 						@if($v->status=='1')
							<table class="table table-hover" border="1">
								<tr >
									<td>
										商品名：{{$v->goodsname}}
									</td>
								</tr>
								<tr>
									<td>
										销售者：{{$v->username}}
									</td>
								</tr>
								<tr>
									<td>
										购买者：{{session('qname')}}
									</td>
								</tr>
								<tr>
									<td>
										成交金额：{{$v->price}} 元
									</td>
								</tr>
								<tr>
									<td>
										收货人姓名：{{$v->shouname}}
									</td>
								</tr>
								<tr>
									<td>
										收货人地址：{{$v->address}}
									</td>
								</tr>
								<tr>
									<td style="color:red">
										卖家未发货
									</td>
								</tr>
							</table>
							@endif
						@endforeach
						@foreach($data as $k =>$v)
							@if($v->status=='1')
							<table class="table table-hover" border="1">
								<tr>
									<td>
										商品名：{{$v->goodsname}}
									</td>
								</tr>
								<tr>
									<td>
										销售者：{{session('qname')}}
									</td>
								</tr>
								<tr>
									<td>
										购买者：{{$v->username}}
									</td>
								</tr>
								<tr>
									<td>
										成交金额：{{$v->price}} 元
									</td>
								</tr>
								<tr>
									<td>
										收货人姓名：{{$v->shouname}}
									</td>
								</tr>
								<tr>
									<td>
										收货人地址：{{$v->address}}
									</td>
								</tr>
								<tr>
									<td><a href="/Home/User/quedingfahuo?id={{$v->orderid}}"><button class="btn btn-info" type="button">确认发货</button></a></td>
								</tr>

							</table>
							@endif
						@endforeach
						</li>
					<!-- 未发货订单 结束-->

					<!-- 已发货订单 开始-->
						<li>
						@foreach($datt as $k => $v)
	 						@if($v->status=='2')
							<table class="table table-hover" border="1">
								<tr >
									<td>
										商品名：{{$v->goodsname}}
									</td>
								</tr>
								<tr>
									<td>
										销售者：{{$v->username}}
									</td>
								</tr>
								<tr>
									<td>
										购买者：{{session('qname')}}
									</td>
								</tr>
								<tr>
									<td>
										成交金额：{{$v->price}} 元
									</td>
								</tr>
								<tr>
									<td>
										收货人姓名：{{$v->shouname}}
									</td>
								</tr>
								<tr>
									<td>
										收货人地址：{{$v->address}}
									</td>
								</tr>
								<tr>
									<td>
										单号：{{$v->numbers}}
									</td>
								</tr>
								<tr>
									<td><a href="/Home/User/quedingshouhuo?id={{$v->orderid}}"><button class="btn btn-info" type="button">确认收货</button></a></td>
								</tr>
								
							</table>
							@endif
						@endforeach
						@foreach($data as $k =>$v)
							@if($v->status=='2')
							<table class="table table-hover" border="1">
								<tr>
									<td>
										商品名：{{$v->goodsname}}
									</td>
								</tr>
								<tr>
									<td>
										销售者：{{session('qname')}}
									</td>
								</tr>
								<tr>
									<td>
										购买者：{{$v->username}}
									</td>
								</tr>
								<tr>
									<td>
										成交金额：{{$v->price}} 元
									</td>
								</tr>
								<tr>
									<td>
										收货人姓名：{{$v->shouname}}
									</td>
								</tr>
								<tr>
									<td>
										收货人地址：{{$v->address}}
									</td>
								</tr>
								<tr>
									<td>
										单号：{{$v->numbers}}
									</td>
								</tr>
								<tr>
									<td style="color:red">
										买家未确认收货
									</td>
								</tr>

							</table>
							@endif
						@endforeach
						</li> 
					<!-- 已发货订单 结束-->

					<!-- 未付款订单 开始-->
						<li>
	 					@foreach($datt as $k => $v)
	 						@if($v->status=='0')
							<table class="table table-hover" border="1">
								<tr >
									<td>
										商品名：{{$v->goodsname}}
									</td>
								</tr>
								<tr>
									<td>
										销售者：{{$v->username}}
									</td>
								</tr>
								<tr>
									<td>
										购买者：{{session('qname')}}
									</td>
								</tr>
								<tr>
									<td>
										成交金额：{{$v->price}} 元
									</td>
								</tr>
								<tr>
									<td>
										收货人姓名：{{$v->shouname}}
									</td>
								</tr>
								<tr>
									<td>
										收货人地址：{{$v->address}}
									</td>
								</tr>
								<tr>
									<td>
										<a href="/Home/User/quedingfukuan?id={{$v->orderid}}"><button class="btn btn-info" type="button">确认付款</button></a>
									</td>
								</tr>
							</table>
							@endif
						@endforeach
						@foreach($data as $k =>$v)
							@if($v->status=='0')
							<table class="table table-hover" border="1">
								<tr>
									<td>
										商品名：{{$v->goodsname}}
									</td>
								</tr>
								<tr>
									<td>
										销售者：{{session('qname')}}
									</td>
								</tr>
								<tr>
									<td>
										购买者：{{$v->username}}
									</td>
								</tr>
								<tr>
									<td>
										成交金额：{{$v->price}} 元
									</td>
								</tr>
								<tr>
									<td>
										收货人姓名：{{$v->shouname}}
									</td>
								</tr>
								<tr>
									<td>
										收货人地址：{{$v->address}}
									</td>
								</tr>
								<tr>
									<td style="color:red">买家未付款</td>
								</tr>

							</table>
							@endif
						@endforeach
						</li>
					<!-- 未付款订单 结束-->

					<!-- 已完成订单 开始-->
						<li>
							@foreach($datt as $k => $v)
	 						@if($v->status=='3')
							<table class="table table-hover" border="1">
								<tr >
									<td>
										商品名：{{$v->goodsname}}
									</td>
								</tr>
								<tr>
									<td>
										销售者：{{$v->username}}
									</td>
								</tr>
								<tr>
									<td>
										购买者：{{session('qname')}}
									</td>
								</tr>
								<tr>
									<td>
										成交金额：{{$v->price}} 元
									</td>
								</tr>
								<tr>
									<td>
										收货人姓名：{{$v->shouname}}
									</td>
								</tr>
								<tr>
									<td>
										收货人地址：{{$v->address}}
									</td>
								</tr>
								<tr>
									<td>
										单号：{{$v->numbers}}
									</td>
								</tr>
								<tr>
									<td>
										<button class="btn btn-info" type="button">我买到的交易已完成</button></a>
									</td>
								</tr>
							</table>
							@endif
						@endforeach
						@foreach($data as $k =>$v)
							@if($v->status=='3')
							<table class="table table-hover" border="1">
								<tr>
									<td>
										商品名：{{$v->goodsname}}
									</td>
								</tr>
								<tr>
									<td>
										销售者：{{session('qname')}}
									</td>
								</tr>
								<tr>
									<td>
										购买者：{{$v->username}}
									</td>
								</tr>
								<tr>
									<td>
										成交金额：{{$v->price}} 元
									</td>
								</tr>
								<tr>
									<td>
										收货人姓名：{{$v->shouname}}
									</td>
								</tr>
								<tr>
									<td>
										收货人地址：{{$v->address}}
									</td>
								</tr>
								<tr>
									<td>
										单号：{{$v->numbers}}
									</td>
								</tr>
								<tr>
									<td>
										<button class="btn btn-info" type="button">我卖出的交易已完成</button></a>
									</td>
								</tr>

							</table>
							@endif
						@endforeach
						</li>
					<!-- 已完成订单 结束-->

					</ul>
				</div>
				<!-- 选项卡的js 开始 -->
					<script type="text/javascript">
						//获取所有选项
						var options = document.getElementById('option').getElementsByTagName('li');
						//获取所有的卡
						var cards = document.getElementById('card').getElementsByTagName('li');

						//遍历
						for (var i = 0; i < options.length; i++) {
							//给options添加一个属性 index 记录了它的索引 是第几个
							options[i].index = i;
							options[i].onclick = function()
							{
								//在事例处理时 将所有的class移出
								for(var j=0;j<options.length;j++){
									//所有的选项都取消calss
									options[j].className = '';
									cards[j].className = '';
								}
								//当前点中的选项 添加 active
								this.className = 'active';
								//给当前的ka添加class
								cards[this.index].className = 'active';
							}
						};
					</script>
				<!-- 选项卡的js 结束  -->

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	<!-- 我的订单 结束 -->

<!-- 模态框结束 -->
@endsection







