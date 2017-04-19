<!-- Wrapper for slides -->
<div class="carousel-inner" role="listbox">
	<div class="item active" style="width:1450px;height:600px">
		<a href="/Home/Goods/index?id={{$lunbofirst->cate_id}}&name={{$lunbofirst->name}}">
	  		<img src="/config/{{$lunbofirst->pic}}" style="width:1450px;">
		</a>
	  	<div class="carousel-caption"> 
		</div>
	</div>
@foreach($lunbo as $k=>$v)
	<div class="item" style="width:1450px;height:600px">
	  	<a href="/Home/Goods/index?id={{$v->cate_id}}&name={{$v->name}}">
	  		<img src="/config/{{$v->pic}}" style="width:1450px;height:600px">
	  	</a>
		<div class="carousel-caption">
	  	</div>
	</div>
@endforeach
</div>
