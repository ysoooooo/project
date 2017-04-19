@extends('Admin.User.parent')
@section('title','fish添加')
@section('content')
<div class="panel-body">
    <div class="row">
    <!-- 验证 开始 -->
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                <li>{{ $errors->first() }}</li>
            </ul>
        </div>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    <!-- 验证 结束 -->
        <div class="col-lg-6 col-lg-offset-3">
        <!--后台管理员添加用户表单  开始-->
            <form role="form" method="post" action="/Admin/Yutang/insert" enctype="multipart/form-data">

                <div class="form-group">
                    <label>所属类别:</label>
                    <select class="form-control" name="cate_id">
                      @foreach($catelist as $k=>$v)
                        <option value="{{$v->id}}">{{$v->name}}</option>
                      @endforeach
                    </select>
                </div> 

                <div class="form-group">
                    <label class="control-label">鱼塘名称:</label>
                    <input class="form-control"name="t_name"type="text" required="required" class="form-control" value="{{old('name')}}">  
                </div>

                <div class="form-group">
                    <label>塘logo：</label>
                    <input type="file" name="t_pic">
                </div>

                <div class="form-group">
                    <label>塘bac：</label>
                    <input type="file" name="t_bac">
                </div>

                 <div class="form-group">
                    <label class="control-label">t_title:</label>
                    <input class="form-control"name="t_title"type="text" required="required" class="form-control" value="{{old('name')}}">  
                </div>

                    {{ csrf_field() }}

                <button type="submit" class="btn btn-default">添加</button>
                <button type="reset" class="btn btn-default">重置</button>
            </form>
        <!--后台管理员添加用户表单  结束-->
        </div>
    </div>
    <!-- /.row (nested) -->
</div>
@endsection
