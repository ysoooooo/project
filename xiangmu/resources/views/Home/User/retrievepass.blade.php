@extends('Home.index')
@section('content')
<div class="container">
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron has-warning">
    	<label class="control-label" for="inputSuccess"><h3>请填写新密码 !</h3></label>
    </div>
</div>

</div> <!-- /container -->

<div class="row">
    <div class="col-xs-6 col-md-4"></div>
    <div class="col-xs-6 col-md-12 subscribe">
        <!-- 开始 -->
        <form method="post" action="/Home/Retrieve/retrieve" id="retrieve">
            <div class="form-group has-warning">
                密 码:
                <input type="text"  required="required" name="password" id="inputWarning" placeholder="请输入新密码">

                <!-- <input type="password" class="form-control" name="password" id="inputWarning"> -->
                <label class="control-label" for="inputSuccess"><h4>请输入6-18位密码</h4></label>
            </div>
            <br>
            <div class="form-group has-warning">
                确认密码:
                <input type="text" class="text"placeholder="请再次输入新密码" name="repassword" id="inputError">
                <input type="hidden" class="form-control" name="phone" id="inputError" value="{{ $phone }}">
                <label class="control-label" for="inputSuccess"><h4>请再次输入密码</h4></label>
            </div>
            <br>
            {{ csrf_field() }}
            <!-- <button type="" class="btn btn-default">提交</button> -->
            <input type="submit" value="提交">
        </form>
        <!--结束 -->
    </div>
    <div class="col-xs-6 col-md-4"></div>
</div>

<!-- 表单验证 -->
<script type="text/javascript">
    //全局变量
    var PassisOK = false;
    var RePassisOk = false;
    //绑定表单提交事件
    $('#retrieve').submit(function () {
        //触发所有的丧失焦点事件
        $('input').trigger('blur');

        //检测所有字段是否正确
        if (PhoneisOK && RePassisOk) {
            return true;
        } else {
            //阻止默认行为
            return false;
        }
    })

    //给所有的输入框 绑定 获取焦点事件 展示提示信息
    $('input').focus(function () {
        $('.control-label').show();
    })

    //密码验证
    $('input[name=password]').blur(function () {
        var reg = /^\w{6,18}$/;
        if (reg.test($(this).val())) {
            PassisOk = true;
            $(this).parents('.form-group').removeClass('has-warning').addClass('has-success').find('label').html('ok!ok!ok!');
        } else {
            $(this).parents('.form-group').removeClass('has-warning').addClass('has-error').find('label').html('密码不符合要求');
            PassisOk = false;
        }
    })

    //确认密码验证
    $('input[name=repassword]').blur(function () {
        var reg = /^\w{6,18}$/;
        var pass = $('input[name=repassword]').val();
        if (reg.test($(this).val()) && $(this).val() == pass) {
            $(this).parents('.form-group').removeClass('has-warning').addClass('has-success').find('label').html('ok!ok!ok!');
            RePassisOk = true;
        } else {
            $(this).parents('.form-group').removeClass('has-warning').addClass('has-error').find('label').html('两次密码不一样');
            RePassisOk = false;
        }
    })
</script>

@endsection
