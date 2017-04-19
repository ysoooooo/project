@extends('Home.index')
        <link href="/homes/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />
		<link href="/homes/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
@section('content')
<hr>
	<div class="col-md-7 col-md-offset-5"><h1>修改</h1></div>
	<hr>
	<div class="bs-example">
	<hr>
      <form role="form" method="post" action="/Home/User/editgoods" style="width:600px;margin-left:400px;margin-top:50px" enctype="multipart/form-data">
        <div class="form-group">
          <label for="exampleInputEmail1">商品名</label>
          <input class="form-control" id="exampleInputEmail1" name="goodsname" value="{{$res->goodsname}}">
        </div>
         <div class="form-group">
          <label for="exampleInputEmail1">商品简介</label>
          <input class="form-control" id="exampleInputEmail1" name="goodstitle" value="{{$res->goodstitle}}">
        </div>
        {{ csrf_field() }}
        <div class="form-group">
          <label for="exampleInputEmail1">商品价格</label>
          <input class="form-control" id="" name="price" value="{{$res->price}}" >
        </div>
        <input type="hidden" name="id" value="{{$res->id}}"> 
        <button type="submit" class="btn btn-default">修改</button>

      </form>
    </div>



	</form>


@endsection
