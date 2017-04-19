<ul class="dropdown-menu multi-column columns-4" style="background:url('/web/paimai.jpg')">
	<div class="row">
	@foreach($res as $k=>$v)
		<div class="col-sm-2">	
			<h4>{{$k}}</h4>
			@foreach($v as $vv)
				@foreach($vv as $vvv)
					<ul class="multi-column-dropdown">
						<li><a class="list" href="/Home/Goods/index?id={{$vvv->id}}&name={{$vvv->name}}">{{$vvv->name}}</a></li>
					</ul>
				@endforeach
			@endforeach 	
		</div>	
	@endforeach																		
	</div>
</ul>