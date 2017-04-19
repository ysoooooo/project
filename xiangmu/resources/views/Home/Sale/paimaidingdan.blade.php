@extends('Home.index')
@section('content')
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
      
<h1>查看拍卖订单</h1>
    <table class="table" style='margin-top:50px'>
      
        <tr class="active">       
            <td class="active">
            拍卖商品名： {{$data->title}}
            </td> 
        </tr>
        <tr class="success">
            <td class="success"> 
            发布拍卖者：{{session('qname')}}
            </td>
        </tr>
        <tr class="warning">  
            <td class="danger"> 
            拍买者：{{$data->username}}
            </td>
        </tr>
        <tr>
            <td>
            收货人姓名：{{$data->shouname}}
            </td>
        </tr>
        <tr>
            <td>
            收货人地址：{{$data->address}}
            </td>
        </tr>
        <tr>
            <td>
            单号：{{$data->numbers}}    
            </td>
        </tr>
        <tr>
            <td><a href="/Home/User/querenfahuo?id={{$data->saleid}}"><button class="btn btn-info" type="button">确认发货</button></a></td>
        </tr>

    </table>

  </div>
  <div class="col-md-4"></div>
</div>
@endsection