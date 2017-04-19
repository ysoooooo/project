@extends('Home.index')

@section('content')
	
  	<h1>请填写您的收货信息</h1>
<div class="row">

   <div class="col-md-4"></div>
   <div class="col-md-4">
  		<form action="quedingjiaoyiye">

		<input type="hidden" name="sale_id" value="{{$sale_id}}">
	  	<table class="table table-striped">
	  		<tr>
	  			<td>
	  				收货地址 ：<select name="shou_address">
	  					@foreach($data as $k=>$v)
	  						<option value="{{$v->shou_address}}">{{$v->shou_address}}</option>
	  					@endforeach
	  				</select><br>
	  				温馨提示：个人中心可以添加收货地址
	  			</td>
	  		</tr>
	  		<tr>
		  		<td>
		  			收货人：   <input type="text" name="shouname" required='required'>
		  		</td>
		  	</tr>

		  	<tr>	
		  		<td>
		  	收货人电话：<input type="text" name="shoutelphone" required='required'>
		  		</td>
	  		</tr>

	  		<tr>
	  			<td>
	  				<button type="submit" class="btn btn-success">下一步</button>
	  			</td>
	  		</tr>
	  	</table>
  	</form>
   </div>
   <div class="col-md-4" style="height:300px"></div>
</div>
@endsection
