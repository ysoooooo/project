@extends('Admin.User.parent')
@section('title','用户添加')
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
            <form role="form" method="post" action="/Admin/User/insert" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">用户名:</label>
                    <input class="form-control"name="username"type="text" required="required" class="form-control" value="{{old('name')}}">  
                </div>
                <div class="form-group">
                    <label class="control-label">手机号:</label>
                    <input class="form-control"name="phone"type="text" required="required" class="form-control" value="{{old('name')}}">  
                </div>
            
                <div class="form-group">
                    <label>权限:</label>
                    <select class="form-control" name="auth">
                      <option value="1">请选择权限</option>
                      <option value="3">管理员  </option>
                      <option value="1">普通用户</option>
                    </select>
                </div>
                <div class="form-group" >

                    <label class="control-label">密码:</label>
                    
                    <input class="form-control"name="password"type="password" required="required" class="form-control" value="{{old('name')}}">    
                </div>
                
                 <div class="form-group">
                            <label>头像：</label>
                            <input type="file" name="pic">
                        </div>

                {{ csrf_field() }}
                <input type="hidden" name="created_at" value="{{time()}}">
                <button type="submit" class="btn btn-default">添加</button>
                <button type="reset" class="btn btn-default">重置</button>
            </form>
        <!--后台管理员添加用户表单  结束-->
        </div>
    </div>
    <!-- /.row (nested) -->
</div>
@endsection
<!-- ajax 验证用户名 开始 -->
    @section('js')
        <script>
            var UserisOk = true;
            $('form').submit(function()
            {
                //触发所有的丧失焦点事件
                $('input').trigger('blur');
                if(UserisOk){
                    return true;
                }else{
                    //阻止默认行为
                    return false;
                }
            })
            
            $('input[name=username]').blur(function()
            {
                var inp = $(this);
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });
                $.ajax({
                    url:'/Admin/User/ajax',
                    data:{username:inp.val()},
                    type:'post',
                    success:function(data){
                        if(data =='0'){
                            UserisOk = false;
                            
                        }else{
                            UserisOk = true;    
                        }
                    },
                    async:false
                })
            })     

        </script>
    @endsection
<!-- ajax 验证用户名 结束 -->
