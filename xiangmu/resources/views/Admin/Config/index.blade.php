@extends('Admin.User.parent')
@section('title','网站配置')
@section('content')
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
        @foreach($res as $v)
            <form role="form" method="post" action="{{url('/Admin/Config/update')}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label>配置名称:</label>
                    <input class="form-control"name="webname"type="text" value="{{$v->webname}}">
                   
                </div>
                <div class="form-group">
                    <label>关键字:</label>
                     <input class="form-control"name="keywords"type="text" value="{{$v->keywords}}">
                </div>
                <div class="form-group">
                    <label>网站版权:</label>
                     <input class="form-control"name="copy"type="text" value="{{$v->copy}}">
                </div>
                <div class="form-group">
                    <label>logo:</label>
                     <input type="file" name="logo" value="/uploads/{{$v->logo}}">
                </div>
                <div class="form-group">
                    <label>网站维护:</label>
                    <select class="form-control" name="status">
                        <option value="1" {{$v->status==1?'selected':''}}>开启</option>
                        <option value="0" {{$v->status==0?'selected':''}}>关闭</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$v->id}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-default">提交</button>
                <button type="reset" class="btn btn-default">重置</button>
            </form>
            @endforeach
        </div>
       
        <!-- /.col-lg-6 (nested) -->
    </div>
    <!-- /.row (nested) -->
</div>



@endsection