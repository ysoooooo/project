@extends('Home.index')
        <link href="/homes/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />
		<link href="/homes/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
@section('content')
<hr>
	<div class="col-md-7 col-md-offset-5"><h1>商品信息</h1></div>
	<hr>
	<div class="bs-example">
        <table  style="width:600px;margin-left:400px;margin-top:100px;border-collapse:separate; border-spacing:0px 10px;" >
          <tr>
            <td>商品名</td>
            <td>{{$goodsxinxi->goodsname}}</td>
          </tr>
          <tr>
            <td>商品类型</td>
            <td>{{$goodscate->name}}</td>
          </tr>
          <tr>
            <td>商品简介</td>
            <td>{{$goodsxinxi->goodstitle}}</td>
          </tr>
         <tr>
            <td>成交价格</td>
            <td>{{$goodsxinxi->price}} 元</td>
          </tr>
         <tr>
            <td>商品买家</td>
            <td>{{$goodsxinxi->username}}</td>
          </tr>
         <tr>
            <td>商品状态</td>
            <td>@if($goodsxinxi->b_id == 0)
                  未出售
                  @else
                  已出售
                  @endif
            </td>
          </tr>
          <tr>
            <td>商品图片</td>
            <td>         
               @foreach($goodspic as $k => $v)
                  <img src="/goods/{{$v->pic}}" alt="" width="100px">　
                @endforeach
            </td>
          </tr>
        </table>
   </div>


@endsection
