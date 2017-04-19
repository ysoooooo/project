@extends('Home.index')
        <link href="/homes/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />
		<link href="/homes/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
@section('content')
<hr>
	<div class="col-md-7 col-md-offset-5"><h1>图片修改</h1></div>
	<hr>
	<div class="bs-example">
	<hr>
      <form role="form" method="post" action="/Home/User/editgoodspicpic" style="width:600px;margin-left:400px;margin-top:50px" enctype="multipart/form-data">
       原图： <img src="/goods/{{$ytu->pic}}" alt="asd" width="100px"><br><hr>
       请选择你要上传的头像     <input type="file" name="pic">
       <hr>
         {{ csrf_field() }}
       <input type="hidden" name="id" value="{{$ytu->id}}">
       <input type="submit" value="确定">
      </form>
    </div>



	</form>


@endsection
