@extends('Home.index')
@section('content')
<h1>我的收货地址列表</h1>
<div class="row">

   <div class="col-md-4"></div>
   <div class="col-md-4">
  		
		<table class="table table-striped">
			<tr>
				<td>收货地址</td>
				<td>操作</td>
			</tr>
		@foreach($data as $k=>$v)
			<tr>
				<td>{{$v->shou_address}}</td>
				<td>
					<a href="">删除</a>	
				</td>
			</tr>
		@endforeach  
		</table>
		<a href="/Home/User/shouhuodizhiadd"><button type="button" class="btn btn-success">添加地址</button></a>
   </div>
   <div class="col-md-4" style="height:300px"></div>
</div>

@endsection







