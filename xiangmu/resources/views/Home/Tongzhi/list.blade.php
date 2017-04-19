@extends('Home.index')

@section('content')
	
<center>
	<h1>我的消息列表</h1>
	<table style="table-layout: fixed;width:900px;" class="table table-bordered">
		<tr>
			<th>发送者</th>
			<th>发送内容</th>
			<th>发送时间</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
		@foreach($data as $v)
			<tr>
				<td>{{$v->f_name}}</td>
				<td style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">
					{{$v->content}}
				</td>
				<td>{{date('Y-m-d h:i:s',$v->regdate)}}</td>
				<td>
					@if($v->dufou=='0')
					未读
					@else
					已读
					@endif
				</td>
				<td>
					<a href="/Home/Tongzhi/see?id={{$v->id}}"><button type="button" class="btn btn-success">查看</button></a> 
					<a href="/Home/Tongzhi/delete?id={{$v->id}}"><button type="button" class="btn btn-danger">删除</button></a> 
				</td>
			</tr>	
		@endforeach
	</table>
	<div style="height:300px"></div>
</center>	
@endsection