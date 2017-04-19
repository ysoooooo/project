@extends('Admin.User.parent')
@section('title','修改友情链接')
@section('content')
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <form role="form" method="post" action="/Admin/Friendlink/update" enctype="multipart/form-data">
                <div class="form-group">
                    <label>链接名称:</label>
                    <input class="form-control"name="linkname"type="text" value="{{$res->linkname}}">
                   
                </div>
                <div class="form-group">
                    <label>链接地址:</label>
                     <input class="form-control"name="url"type="text" value="{{$res->url}}">
                </div>
                <div class="form-group">
                    <label>链接内容:</label>
                     <input class="form-control"name="content"type="text" value="{{$res->content}}">
                </div>
                
                <input type="hidden" name="id" value="{{$res->id}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-default">修改</button>
                
            </form>
        </div>
       
        <!-- /.col-lg-6 (nested) -->
    </div>
    <!-- /.row (nested) -->
</div>
@endsection