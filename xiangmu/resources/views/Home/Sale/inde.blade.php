@extends('Home.index')
@section('content')
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
      

<table class="table" style='margin-top:50px'>
    <!-- On rows -->
    
    <tr class="active"> 
    
    <td class="active"><a href="/Home/User/user?id={{$data['id']}}">夺魁者 ===== {{$data['username']}} </a>    </td>
  
    </tr>

    <tr class="success"> <td class="success"> 拍卖品   =====   {{$data['pname']}} </td></tr>
    <tr class="warning">  <td class="danger"> 成交价    =====  {{$data['price']}} 元</td></tr>
   

   
</table>

  </div>
  <div class="col-md-4"></div>
</div>
@endsection