@extends('Admin.User.parent')
@section('title','轮播修改')
@section('content')
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <form role="form" method="post" action="/Admin/Lunbo/update" enctype="multipart/form-data">
               <div class="form-group">
                    <label>轮播图:</label>
                    <img src="/config/{{$res->pic}}" alt=""style="width:300px">
                    <input type="hidden" name="old_pic" value="{{$res->pic}}">
                    <input type="file" name="pic">
                    <input type="hidden" name="id" value="{{$id}}">
                </div>
                 <div class="form-group">
                    <label>类别id:</label>
                    <select class="form-control" name="cate_id">
                        @foreach($cate as $v)
                            <option value="{{$v->id}}">{{$v->name}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-default">修改</button>
                
            </form>
        <!-- /.col-lg-6 (nested) -->
    </div>
    <!-- /.row (nested) -->
</div>
@endsection