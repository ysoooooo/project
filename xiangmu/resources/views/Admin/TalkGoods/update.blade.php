@extends('Admin.User.parent')
@section('title','修改')


@section('content')
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <form role="form" method="post" action="/Admin/User/update">
                <div class="form-group">
                    <label>用户名:</label>
                    <input class="form-control" name="username" type="text" value="{{$res->username}}">
                </div>
                <div class="form-group">
                    <label>性别:</label>
                    <div class="radio">
                        <label>
                            <input name="sex" id="optionsRadios1" value="0"
                                   {{ $resd->sex==0 ?'checked':''}} type="radio">女
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input name="sex" id="optionsRadios2" value="1"
                                   {{ $resd->sex==1 ?'checked':''}} type="radio">男
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>昵称:</label>
                    <input class="form-control" name="uname" type="text" value="{{$resd->uname}}">
                </div>
                <div class="form-group">
                    <label>权限:</label>
                    <select class="form-control" name="auth">
                        <option value="">请选择权限</option>
                        <option value="3" {{$res->auth==3?'selected':''}}>管理员</option>
                        <option value="1" {{$res->auth==1?'selected':''}}>普通用户</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$res->id}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="update_at" value="{{time()}}">
                <button type="submit" class="btn btn-default">修改</button>
            </form>
        </div>
    </div>
</div>
@endsection