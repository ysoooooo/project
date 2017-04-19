@extends('Home.index')
        <link href="/homes/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />
		<link href="/homes/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
@section('content')
<hr>
	<div class="col-md-7 col-md-offset-5"><h1>图片修改</h1></div>
	<hr>
	<div class="bs-example">
	<hr>
      <form role="form" method="post" action="/Home/User/editgoodspic" style="width:600px;margin-left:400px;margin-top:50px" enctype="multipart/form-data">
        <table  style="border-collapse:separate; border-spacing:0px 10px;" > 
        @foreach($res as $k => $v)
          <tr>
           
            <td>  
           
                <img src="/goods/{{$v->pic}}" alt="" width="115px" height="100px">
         
           　    <a href="/Home/User/updgoodspicpic?id={{$res[$k]->id}}"><button type="button" class="btn btn-warning">操作</button></a>
                 <a href="/Home/User/delgoodspic?id={{$res[$k]->id}}"><button class="btn btn-danger" type="button">删除</button></a>　
            </td>  
           
          </tr> 
         @endforeach
        </table>
     
      </form>
    </div>



	</form>


@endsection
