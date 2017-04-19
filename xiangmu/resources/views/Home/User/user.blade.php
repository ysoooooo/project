@extends('Home.index')
@section('content')
	

    <div class="container" style="margin-top:20px">

      	<div class="row row-offcanvas row-offcanvas-right">

        	<div class="col-xs-12 col-sm-9">
		        <p class="pull-right visible-xs">
		            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
		        </p>
	          	<div class="jumbotron">
		            <h1>{{$user->username}}的个人中心</h1>
		            <p>
		            	<img src="/uploads/{{$user->pic}}" alt="没发现" width="60px">　　　　　　　　　　积分：{{$user->integral}}
		            </p>
	          	</div>
		        <div class="row">
		            <div class="col-xs-12 col-sm-9">
						<table class="table table-condensed">
						  	<tr>
						  		<td>用户名：</td>
						  		<td> {{$user->username}} </td>
						  	</tr>
						  	<tr>
						  		<td>昵  称：</td>
						  		<td> {{$user->uname}} </td>
						  	</tr>
						  	<tr>
						  		<td>性  别：</td>
						  		<td> 
							  		@if($user->sex == 0 ) 
	                                    女
	                                @elseif($user->sex == 1)
	                                    男
	                                @else
	                                    未知
	                                @endif 
                                </td>
						  	</tr>
							<tr>
						  		<td>手机号：</td>
						  		<td> {{$user->phone}} </td>
						  	</tr>
						  	<tr>
						  		<td>常住地址：</td>
						  		<td> {{$user->address}} </td>
						  	</tr>
						  	<tr>
						  		<td>邮 箱 ：</td>
						  		<td> {{$user->email}} </td>
						  	</tr>
						</table>
						<!--他发布的商品和拍卖按钮鱼塘 开始 -->
							<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#mygoods">
							  	ta发布的商品
							</button><br><br>
							<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#mypaimai">
							  	ta发布的拍卖
							</button>
							<br><br>
							<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myyutang">
							  	ta加入的鱼塘
							</button>
						<!--他发布的商品和拍卖按钮鱼塘 结束 -->

						<!-- 他发布的商品模态框 开始 -->
							<div class="modal fade" id="mygoods" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  	<div class="modal-dialog">
							    	<div class="modal-content">
							      		<div class="modal-header">
							        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							        		<h4 class="modal-title" id="myModalLabel">ta发布的商品</h4>
							      		</div>
								      	<div class="modal-body">
								      		@foreach($goods as $v)
									        	<table class="table table-striped">
									        		<tr>
									        			<td>商品名：</td>
									        			<td>{{$v->goodsname}}</td>
									        		</tr>
									        		<tr>
									        			<td>价格:</td>
									        			<td>{{$v->price}}元</td>
									        		</tr>
									        		<tr>
									        			<td>介绍:</td>
									        			<td>{{$v->goodstitle}}</td>
									        		</tr>
									        		<tr>
									        			<td>状态：</td>
									        			<td>
									        				@if($v->b_id)
									        					已出售
									        				@else
									        					正在出售 　　　　<a href="/Home/Goods/detail?id={{$v->id}}">查看</a>
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
							</div>
						<!-- 他发布的商品模态框 结束 -->

						<!-- 他发布的拍卖模态框 开始 -->
							<div class="modal fade" id="mypaimai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  	<div class="modal-dialog">
							    	<div class="modal-content">
							      		<div class="modal-header">
							        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							        		<h4 class="modal-title" id="myModalLabel">ta发布的拍卖</h4>
							      		</div>
								      	<div class="modal-body">
								      	@foreach($paimai as $v)
								        	<table class="table table-striped">
								        		<tr>
								        			<td>拍卖商品名：</td>
								        			<td>{{$v->title}}</td>
								        		</tr>
								        		<tr>
								        			<td>拍卖底价:</td>
								        			<td>{{$v->dprice}}元</td>
								        		</tr>
								        		<tr>
								        			<td>最高价格:</td>
								        			<td>
								        				@if($v->hprice)
								        					{{$v->hprice}} 元
								        				@else
								        					{{$v->dprice}} 元
								        				@endif
								        			</td>
								        		</tr>
								        		<tr>
								        			<td>拍卖介绍:</td>
								        			<td>{{$v->keyword}}</td>
								        		</tr>
								        		<tr>
								        			<td>拍卖状态：</td>
								        			<td>
								        				@if($v->b_id)
								        					拍卖已结束 已被拍走								       	　　
								        				
								        				@elseif(strtotime($v->ltime)>time())
								        					拍卖中。。。
								        					<a href="/Home/Auction/xq?id={{$v->id}}">去出个价</a>
								        				@else
								        				拍卖结束。。。无人拍买
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
							</div>
						<!-- 他发布的拍卖模态框 结束 -->

						<!-- 他加入的鱼塘模态框 开始 -->
							<div class="modal fade" id="myyutang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  	<div class="modal-dialog">
							    	<div class="modal-content">
							      		<div class="modal-header">
							        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							        		<h4 class="modal-title" id="myModalLabel">ta加入的鱼塘</h4>
							      		</div>
								      	<div class="modal-body">
								       		<table class="table table-striped">
								       		@foreach($fish as $v)
								       			<tr>
								       				<td>
								       				<a href="/Home/Fish/detail?id={{$v->fish_id}}"><button type="button" class="btn btn-success">{{$v->t_name}}</button></a>
								       				　　　　
								       				@if($v->tz_id==$user->id)
								       					塘主
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
							</div>
						<!-- 他加入的鱼塘模态框 结束 -->

		            </div><!--/span-->
		        </div><!--/row-->
       	 	</div><!--/span-->

	        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
	          	<div class="list-group">
		            <!-- 点赞按钮  开始 -->
						<div class="btn_form" id="shifouguanzhu" >
							<a href="javascript:void(0)" class="add-cart item_add" id="woyaoguanzhu" >
							@if($res==1)
								取消关注
							@else
								关注ta
							@endif
							</a>		
				
							<span>已经有<span id="guanzhushuliang">{{$guanzhu}}</span>人关注</span>
							<input type="hidden" name="yonghuid" value="{{$user->id}}">
						</div>
					<!-- 点赞按钮   结束 -->
		          	<button type="button" class="btn btn-warning fasixin">发私信</button><br><br>
		          	<form action="" method="post" style="display:none" class="sixin">
							<textarea class="form-control con" rows="3" sid="{{$user->id}}" sname="{{$user->username}}">
							</textarea>
							{{ csrf_field() }}
							<br><br>
							<button type="submit" class="btn btn-success send">发送私信</button>
					</form>	
	          	</div>
	        </div><!--/span-->
	    </div>    
   	</div>
<script>
	// 发送私信的操作 开始
		$('.fasixin').click(function(){
			$(this).css('display','none');
			$('.sixin').css('display','block');
		})

	  	$('.send').click(function(){
			// 获取要发送的内容
				var con=$('.con').val();
				var sid=$('.con').attr('sid');
				var sname=$('.con').attr('sname');
				if(!con)
				{
					alert(1);
					$('.sixin').css('display','none');
					$('.fasixin').show();
					return false;	
				}else
				{
						//  发送ajax
					$.ajaxSetup({
					        headers: {
					            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					        }
					});	 
					$.post('/Home/User/fasixin',{con:con,sid:sid,sname:sname},function(data){
							if(data)
							{
								$('.sixin').css('display','none');
								$('.fasixin').show();
								alert('发送成功！');
							}                                            
							
					},'json');
				    return false; 
				}
		})
    // 发送私信的操作 结束


	// 关注的操作 开始
		var aaa = $('#woyaoguanzhu').text().replace(/(^\s*)|(\s*$)/g, ""); 
	  
		var pid = $('input[name=yonghuid]').val();
		
		

			$('#woyaoguanzhu').click(function()
			{
				
				// 发送ajax
					$.ajaxSetup({
			            headers: {
			                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			         	   }
			    		});		
					if (aaa == "关注ta")
					{
					 
				 		$.ajax({
				 			url:'/Home/User/guanzhushu',
				 			type:'post',
				 			data:{id:pid},
				 			success:function(data){
				 				$('#guanzhushuliang').html(data); 
				 				$('#woyaoguanzhu').html('取消');
				 				aaa='取消关注';
				 			},
				 		});
				
				 	}else if(aaa == '取消关注')
				 	{
				 	
					  	$.ajax({
					 		url:'/Home/User/quxiaoguanzhu',
					 		type:'post',
					 		data:{id:pid},
					 		success:function(data){
					 		
						 		$('#guanzhushuliang').html(data); 
						 		$('#woyaoguanzhu').html('关注ta');
						 		aaa='关注ta';
					 		},
				 	
				 		});
						return false;	
					} 	
			})		
	// 关注的操作 结束

	
		  
</script>
     





@endsection