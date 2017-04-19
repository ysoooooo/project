<div class="footer">
		<div class="container">
			<div class="footer-grids">
			@foreach($friend as $k=>$v)
				<div class="col-md-2 footer-grid">
					<ul>
						<li><a href="{{$v->url}}" title="{{$v->content}}"><p>{{$v->linkname}}</p></a></li>
					</ul>
				</div>
			@endforeach
			</div>
		</div>
	</div>