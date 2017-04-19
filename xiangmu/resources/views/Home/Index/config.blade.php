<div class="footer-bottom">
	
	@foreach($con as $k=>$v)
	<div class="container">
		<p>{{$v->copy}} &copy; 2017.Company name All rights reserved.More Templates <a href="http://www.baidu.com/" target="_blank" title="百度一下，你就知道">{{$v->keywords}}</a> </p>
	</div>
	@endforeach
</div>