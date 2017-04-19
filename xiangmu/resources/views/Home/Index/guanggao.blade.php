<!-- 广告 -->
	 @foreach ($ads as $k=>$v)
	 <style type="text/css">
	#move{
		margin-left:5px;
		position:absolute;
		top:200px;
		width:100px;
	}
	#imge{
		position:fixed;
	}
	.title{
			position:fixed;
	}
	 </style>
		
	<div >
		<div id="move">
			<img id="imge" src="{{$v->pic}}" style="width:130px;height:350px;">
			<div class="title" style="margin-top:350px;font-size:17px;">{{$v->title}}</div>
			<br><br>
			<div class="title" style="margin-top:350px;width:130px;">{{$v->explain}}</div>	
		</div>	
	</div>

	<script type="text/javascript">
	
	//获取元素
	var imge = document.getElementById('imge');
	
	//绑定事件
	imge.onclick = function(){
		window.location.href="{{$v->link}}";
	}

	</script>
 	@endforeach	