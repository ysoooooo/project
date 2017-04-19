@extends('Home.index')
@section('content')	
	  	<h1>确认购买</h1>
<div class="row">

   <div class="col-md-4"></div>
   <div class="col-md-4">
  		
	  	<table class="table table-bordered">
	  		<tr>
	  			<th>商品名：</th>
	  			<td>{{$data->goodsname}}</td>
	  					
	  		</tr>
	  		<tr>
	  			<th>价格：</th>
	  			<td>{{$data->price}} 元</td>
	  			
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
	  				<a href="doqueding?goods_id={{$data->id}}&shou_address={{$data->shou_address}}&shouname={{$data->shouname}}&shoutelphone={{$data->shoutelphone}}">
						<button type="button" class="btn btn-success">提交订单</button>
	  				</a>
	  				<a href="/Home/Goods/detail?id={{$data->id}}">
						<button type="button" class="btn btn-danger">放弃交易</button>
	  				</a>
  				</td>
	  		</tr>
	  	</table>
  	
   </div>
   <div class="col-md-4" style="height:300px"></div>
</div>
@endsection
