@extends('Admin.User.parent')
@section('title','添加友情链接')
@section('content')
<div class="panel-body">
        <div class="col-lg-6 col-lg-offset-3">
        <!--后台添加友情链接表单  开始-->
            <form role="form" method="post" action="{{url('Admin/Friendlink/insert')}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">链接名称:</label>
                    <input class="form-control" name="linkname" value="{{old('linkvalue')}}"type="text" required="required" class="form-control">  
                </div>
                 <div class="form-group">
                    <label class="control-label">链接地址:</label>
                    <input class="form-control" name="url" value="{{old('url')}}"type="text" required="required" class="form-control">  
                </div>
                 <div class="form-group">
                    <label class="control-label">链接内容:</label>
                    <input class="form-control" name="content" value="{{old('content')}}"type="text" required="required" class="form-control">  
                </div>
                 

                {{ csrf_field() }}
                <button type="submit" class="btn btn-default">添加</button>
            </form>
        <!--后台添加友情链接表单  结束-->
        </div>
    </div>
    <!-- /.row (nested) -->
</div>
@endsection