@foreach($arr as $v)
<div class="col-md-4 gallery-grid glry-two" style="margin-top:10px">
	<a href="#">
		@foreach($a as $k) 
		    @if($k->goods_id==$v->id) 
				<img src="./goods/{{$k->pic}}" class="img-responsive" alt="" width="100%" height="100%">
		    @endif
		@endforeach
	</a>

	<div class="gallery-info galrr-info-two">
		<a href="#">
			<p><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> view</p>
		</a>
		<a class="shop" href="/Home/Goods/detail?id={{$v->id}}">查看</a>

		<div class="clearfix"> </div>
	</div>
	
	<div class="galy-info">
		<p>宝贝名：{{$v->goodsname}}</p>
		<div class="galry">
			<div class="prices">
				<h5 class="item_price">$：{{$v->price}}</h5>
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
	</div>
</div>
@endforeach