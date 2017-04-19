@extends('Admin.User.parent')
@section('title','消息内容修改页面')
@section('content')
<div class="row">
    <!-- 发布商品表单 开始 -->
    <div class="col-xs-6 col-md-6">
        <form role="form" action="/Admin/TalkGoods/update" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputPassword1">消息内容:</label>
                <input type="textarea" value="{{$res->content}}" class="form-control"
                       id="exampleInputPassword1" required="required" name="content">
                <input type="hidden" name="rtime" value="{{time()}}">
            </div>
            <input type="hidden" name="id" value="{{$res->id}}">
            <br>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-default">提交修改</button>
        </form>
    </div>
</div>


@endsection

