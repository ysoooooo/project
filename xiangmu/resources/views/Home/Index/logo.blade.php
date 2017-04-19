<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	@foreach($logo as $k=>$v)
	@if(session('qauth')=='3' || session('qauth')=='4')
		<a href="/Admin/User/login"><font style="color:white">后台入口</font></a>
	@endif	
	<h1 class="navbar-brand"><a  href="/"><img src="/config/{{$v->logo}}" width="200px" height="40px"></a></h1>
	@endforeach
</div>
