@foreach($arr as $v)
	<div class="row featurette">
		<div class="col-md-7">
			<a href="/Home/Fish/detail?id={{$v->id}}"><h2 class="featurette-heading">{{$v->t_name}}<span class="text-muted">Checkmate.</span></h2></a> 
			<p class="lead">{{$v->t_title}}</p>
		</div>
		<div class="col-md-5">
	 	<img class="featurette-image img-responsive" src="/fish/{{$v->t_bac}}" alt="Generic placeholder image" width="400px">
		</div>
	</div>
	<hr/>
@endforeach