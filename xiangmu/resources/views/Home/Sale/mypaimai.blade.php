@extends('Home.index')
@section('content')

<div class="row" style="margin-top:50px;margin-bottom:100px">
   <div class="col-md-6">
   		<h3>我发布的拍卖</h3>
		<table class="table">
		  	<tr role="row">
	            <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 100px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting_asc">
	            拍卖名：
	            </th>
	            <th aria-label="Platform(s): activate to sort column ascending" style="width:100px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
	            底价</th>
	            <th aria-label="Engine version: activate to sort column ascending" style="width:100px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
	            成交价</th>
	            <th aria-label="Engine version: activate to sort column ascending" style="width: 100px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
	            结束时间</th>
	             <th aria-label="Engine version: activate to sort column ascending" style="width:200px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
	            状态</th>
	             <th aria-label="CSS grade: activate to sort column ascending" style="width: 300px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
	            操作</th>
            </tr>
            @foreach($fabu as $v)
            <tr>
            	<td>{{$v->title}}</td>
            	<td>{{$v->dprice}}元</td>
            	<td>
            		@if($v->b_id)
            			<a href="/Home/User/pai?b_id={{$v->b_id}}&id={{$v->id}}">点击查看</a>
            		@else
						未成交
            		@endif
            	</td>
            	<td>{{$v->ltime}}</td>
            	<td>
            		@if($v->b_id=='0')
            			进行中
            		@elseif($v->status=='4')
            			未填写收货信息
            		@elseif($v->status=='1')
                        已填写收货地址
                    @elseif($v->status=='2') 
                        等待确认收货 
                    @elseif($v->status=='3')
                        已确认收货，交易完成       
                    @endif    	
            	</td>
                @if($v->b_id=='0')            
            	<td>
	            	<a href="/Home/User/paimaiedit?id={{$v->id}}"><button type="button" class="btn btn-warning">修改</button></a> | 
	            	<a href="/Home/User/paimaidelete?id={{$v->id}}"><button type="button" class="btn btn-danger">删除</button></a>
	            	<a href="/Home/User/paimaipic?id={{$v->id}}"><button type="button" class="btn btn-success">图片介绍</button></a>
            	</td>
                @elseif($v->status=='1')
                <td>
                    <a href="/Home/User/seepaimaidingdan?id={{$v->id}}"><button type="button" class="btn btn-success">查看订单</button></a>
                </td>
                @endif
            </tr> 
            @endforeach
		</table>
   </div>
   <div class="col-md-6">
   		<h3>我拍到的拍卖</h3>
   		<table class="table">
		  		<tr role="row">
	            <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 100px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting_asc">
	            商品名：
	            </th>
	            <th aria-label="Platform(s): activate to sort column ascending" style="width: 100px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
	            发布者</th>
	             <th aria-label="Engine version: activate to sort column ascending" style="width: 164px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
	            拍卖结束时间</th>
	             <th aria-label="CSS grade: activate to sort column ascending" style="width:200px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
	            状态</th>
            </tr>
            @foreach($pai as $v)
            <tr>
            	<td>{{$v->title}}</td>
            	<td>{{$v->username}}</td>
            	<td>{{$v->ltime}}</td>
            	<td>
            		@if($v->status=='1')
            			等待发货
            		@elseif($v->status=='4')
            			已拍下 <a href="/Home/Auction/xuanzedizhiye?id={{$v->id}}"><button type="button" class="btn btn-info">去填写收货信息</button></a>
            		@elseif($v->status=='2')
                        已发货 <a href="/Home/User/querenshouhuo?id={{$v->id}}"><button type="button" class="btn btn-info">确认收货</button></a>
                    @elseif($v->status=='3')
                        确认收货，交易完成
                    @endif		
            	</td>
            </tr> 
            @endforeach
		</table>
   </div>
</div>	
@endsection