@extends('Admin.User.parent')
@section('title','商品添加页面')
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
        <div class="row">
            <!-- 发布商品表单 开始 -->
            <div class="col-xs-6 col-md-6">
                <form role="form" action="/Admin/Goods/insert" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">商品名称:</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" required="required"
                               name="goodsname">
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="exampleInputFile">商品分类:</label>
                            <select class="form-control" required="required" name="P_id">
                                @foreach($cate as $v)
                                    <option name="P_id" value="{{$v->id}}">{{$v->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="exampleInputPassword1">商品价格:</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" required="required"
                               name="price">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">图片简介:</label>
                        <input type="file" id="exampleInputFile" multiple name="pic[]">
                        <p class="help-block">上传图片不要超过四张</p>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">商品简介:</label>
                        <input type="textarea" class="form-control" id="exampleInputPassword1"
                               required="required" name="goodstitle">
                        <input type="hidden" name="s_id" value="{{session('hid')}}">
                        <input type="hidden" name="created_at" value="{{time()}}">
                    </div>
                    <br>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-default">发布</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
