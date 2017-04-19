@extends('Admin.User.parent')
@section('title','商品添加页面')
@section('content')
    <div class="panel-body">
        <div class="row">
            <div class="row">
                <div class="col-xs-6 col-md-6">
                    <form role="form" action="/Admin/Goods/picupdate" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputFile">图片简介:</label>
                            <img src="/goods/{{$res->pic}}" alt=""style="width:300px">
                            <input type="hidden" name="old_pic" value="{{$res->pic}}">
                            <input type="file" name="pic">
                        </div>
                        <input type="hidden" name="id" value="{{$res->id}}">
                        <br>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-default">提交修改图片</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

