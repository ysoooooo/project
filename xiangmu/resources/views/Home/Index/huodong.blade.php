 
	@if($data)
	<div style="position:fixed;bottom:10px;right:10px;width:300px;height:100px;background:url('/web/huodong.jpg')" class="huodong">
		
			<h3  class="ti" ltime='{{$data->ltime}}' tid="{{$data->t_id}}" tname="{{$data->t_name}}">塘主征集令</h3>
			【{{$data->t_name}}】塘开始招塘主了，参与者随机获得塘主资格<br>
			距离结束：<span class="t_dd">00天</span>
	        <span class="t_hh">00时</span>
			<span class="t_mm">00分</span>
	        <span class="t_ss">00秒</span>
	        @if(isset($res))
	        	<button type="button" class="btn btn-success" disabled>已参与</button>
	        @else
				<button type="button" class="btn btn-success" id="canyu">我要参与</button>
			@endif
	</div>
	@endif
<!-- 塘主征集令的定时器 开始 -->
	<script>
		var jtime=$('.ti').attr('ltime');
		ss = 0;
		mm = 0;
		hh = 0;
		dd = 0;
		var GetTime = setInterval(function(){
		   var EndTime = new Date(jtime);
		   var NowTime = new Date();
		   var t =EndTime.getTime() -NowTime.getTime();
		   // 如果结束
		   if(t<=0)
		   {

		   		clearInterval(GetTime);
		   		var tid=$('.ti').attr('tid');
		   		var tname=$('.ti').attr('tname');
		   		$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
				});	 
				$.post('/Home/Auction/jieshu',{tid:tid,tname:tname},function(data){					                    
						if(data)
						{
							$('.huodong').css('display','none');
						}else
						{
							$('.huodong').css('display','none');
						}
				},'json');
		   }else
		   {
		   		var dd=Math.floor(t/1000/60/60/24);
			    var hh=Math.floor(t/1000/60/60%24);
			    var mm=Math.floor(t/1000/60%60);
			    var ss=Math.floor(t/1000%60);

			 	$('.t_dd').html(dd + "天");
			    $('.t_hh').html(hh + "时");
			    $('.t_mm').html(mm + "分");
			    $('.t_ss').html(ss + "秒");

			}
		},0);


		// 参与鱼塘塘主申请的js 开始
			$('#canyu').click(function()
			{
				@if(!session('qid'))
					alert('请先登录');
					return;
				@endif

				@if(session('qauth')=='2')
					alert('您已经是塘主！把机会给别人吧');
					return;
				@endif
				
				var tid=$('.ti').attr('tid');
				var tname=$('.ti').attr('tname');
				var btn=$(this);
				$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
				});	 
				$.post('/Home/Auction/canyu',{tid:tid,tname:tname},function(data){
						 if(data)
						 {
						 	btn.html('已参与');
						 	btn.attr({"disabled":"disabled"});
						 }                   
						
				},'json');
			})
		// 参与鱼塘塘主申请的js 结束
	</script>	
<!-- 塘主征集令的定时器 结束 -->
	
