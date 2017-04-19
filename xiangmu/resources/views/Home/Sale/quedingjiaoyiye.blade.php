@extends('Home.index')
@section('content')	
	  	<h1>确认信息</h1>
<div class="row">

   <div class="col-md-4"></div>
   <div class="col-md-4">
  		
	  	<table class="table table-bordered">
	  		<tr>
	  			<th>商品名：</th>
	  			<td>{{$data->title}}</td>
	  					
	  		</tr>
	  		<tr>
	  			<th>价格：</th>
	  			<td>{{$price}} 元</td>
	  			
	  		</tr>
	  		<tr>
	  			<th>收货人：</th>
	  			<th>{{$data->shouname}}</th>
	  		</tr>
	  		<tr>
	  			<th>收货人电话：</th>
	  			<th>{{$data->shoutelphone}}</th>
	  		</tr>
	  		<tr>
	  			<th>收货地址：</th>
	  			<td>{{$data->shou_address}}</td>
	  		</tr>
	  		<tr>
	  			<td>
	  				<a href="/Home/Auction/doqueding?sale_id={{$data->id}}&shou_address={{$data->shou_address}}&shouname={{$data->shouname}}&shoutelphone={{$data->shoutelphone}}">
						<button type="button" class="btn btn-success">确认信息提交</button>
	  				</a>
  				</td>
	  		</tr>
	  	</table>
  	
   </div>
   <div class="col-md-4" style="height:300px"></div>
</div>
@endsection
