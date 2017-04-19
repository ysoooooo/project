@extends('Home.index')
@section('content')
<div class="container">
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron  has-warning">
    	<label class="control-label" for="inputSuccess"><h4>请认真填写以便于快速找回密码 !</h4></label>
    </div>
</div>
<div class="row" >
    <!-- <div class="col-xs-6 col-md-4"></div> -->
    <div class="col-xs-6 col-md-12 subscribe">
        <!-- 开始 -->
        <form method="post" action="/Home/Retrieve/retrievepass" class="retrieve" id="retrieve">
            <div class="form-group has-warning">
                <input type="text"  required="required" name="phone" placeholder="手机号">
                <input type="hidden" class="phoneh" name="phoneh" id="inputError">
                <label class="control-label" for="inputSuccess" id="tel"><h4>请填写注册手机号,用于找回密码(必填)</h4></label>
            </div>
            <br>
            <div class="form-group has-warning">
                <input type="text" value="" required="required" placeholder="验证码" name="code">

                <button type="button" id="" data-send="0" class="button">
                    <span class="send" style="width:50px;height:59px">获取验证码</span>
                </button>
                <br>
                <label class="control-label" for="inputSuccess" class="cat">请输入验证码</label>
            </div>
            <br>
            {{ csrf_field() }}
            <!-- <button type="submit" class="btn btn-default">提交</button> -->
            <input type="submit" value="提交">
        </form>
        <!--结束 -->
    </div>
    <div class="col-xs-6 col-md-4"></div>
</div>

<!-- 表单验证 -->
<script type="text/javascript">
    //全局变量
    var PhoneisOK = false;
    var CodeisOk = false;
    var ClicklisOk = false;

    //绑定表单提交事件
    $('#retrieve').submit(function () {
        //触发所有的丧失焦点事件
        $('input').trigger('blur');

        //检测所有字段是否正确
        if (PhoneisOK && CodeisOk && ClicklisOk) {
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

    //手机号验证
    $('input[name=phone]').blur(function () {

        var btn = $(this);
        var reg = /^1[3|4|7|5|8][0-9]\d{4,8}$/;
        if (reg.test($(this).val())) {
            PhoneisOK = true;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // 获取手机号
            var phone = $('#retrieve').find('input[name=phone]').val();
            var p = $('#retrieve').find('input[name=phoneh]').val(phone);
            //发送ajax 判断手机号是否注册
            $.ajax({
                url: '/Home/Retrieve/tel',
                type: 'post',
                data: {phone: phone},
                success: function (data) {
                    if (data == 'ok') 
                    {
                        btn.parents('.form-group').removeClass('has-warning').addClass('has-error').find('label').html('请获取验证码');
                        PhoneisOK = ture;

                    }else
                    {
                        btn.parents('.form-group').removeClass('has-warning').addClass('has-error').find('label').html('该手机号未注册');
                        $('.button').attr('disabled','disabled')
                        PhoneisOK = false;
                           
                    }
                },
                async: true

            });

            //发送ajax获取验证码
            $('.button').click(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var btn2 = $(this);
                var r = '';
                var i = 30;
                if (!btn2.attr('dis')) {
                    $.ajax({
                        url: '/Home/Retrieve/code',
                        type: 'post',
                        data: {phone: phone},
                        async: true
                    })
                }
                ClicklisOk = true;
                var init = setInterval(func, 1000);

                btn2.attr('dis', true);
                function func() {
                    i--;
                    btn2.html('重新发送(' + i + ')');
                    //判断i
                    if (i <= 0) {
                        r = '获取验证码';
                        btn2.attr('dis', false);
                        btn2.html(r);
                        clearInterval(init);
                    }
                }
            });

        } else {
            $(this).parents('.form-group').removeClass('has-warning').addClass('has-error').find('label').html('手机号格式不正确');
            PhoneisOk = false;
        }
    })
    // 验证验证码是否正确 开始
    $('input[name=code]').blur(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //获取用户输入的验证码
        var code = $(this).val();
        var links = $(this);
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: '/Home/Retrieve/ycode',
            type: 'post',
            data: {code: code, _token: _token},
            success: function (data) {
                if (data == true) {
                    links.parents('.form-group').find('label').html('验证码正确').css('color', 'green');
                    CodeisOk = true;
                } else {
                    links.parents('.form-group').removeClass('has-warning').addClass('has-error').find('label').html('验证码不正确');
                    CodeisOk = false;
                }
            },
            async: true

        });
    });
    // 验证验证码是否正确 结束

</script>
@endsection
