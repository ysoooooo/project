@extends('Home.index')
@section('content')
<style>
        * { margin: 0; padding: 0; }

		#bg { position: absolute; top: 1; left: 0; }
		.bgwidth { width: 100%; }
		.bgheight { height: 100%; }
        .row { 
            width: 600px;
            margin: 15px auto;
            padding: 20px;
            background: ;
            opacity: 0.8;
            box-shadow: 0 0 20px black;
        }
        .row1 { 
            width: 800px;
            margin: 15px auto;
            padding: 20px;
            background: ;
            opacity: 0.8;
            box-shadow: 0 0 20px black;
        }
        .footer-bottom{ position: absolute; top: 1; left: 0;width: 100%; }
        p { font-weight:bold; color:black;font: 30px/1.8 Georgia, Serif; margin: 0 0 8px 0; text-indent: -20px;height: 100%; }
    </style>
<div class="htn">
<img src="/homes/images/2 (2).jpg" id="bg">

		<div class="row1">
		        <h1>给你一次挣钱的机会！go go go !</h1>
		 </div>
		    </div> <!-- /container -->	
		<div class="row">
		    <div class="col-xs-6 col-md-8">
		    	<!-- 登陆表单 开始 -->
			  		<form method="post" action="/Home/User/register" id="zhuce">
			  		 <div class="form-group has-warning">
			  		   用户名:
			  		   <input type="text" class="form-control" name="username" id="inputSuccess" value="{{old('username')}}">
			  		   <label class="control-label" for="inputSuccess" id="user">请输入6-18位用户名</label>
			  		 </div>
			  		 <div class="form-group has-warning">
			  		  密 码:
			  		  <input type="password" class="form-control"  name="password" id="inputWarning">
			  		   {{ csrf_field() }}
			  		  <label class="control-label" for="inputSuccess">请输入6-18位密码</label>
			  		 </div>
			  		 <div class="form-group has-warning">
			  		  确认密码:
			  		 <input type="password" class="form-control"  name="repassword" id="inputError">
			  		 <label class="control-label" for="inputSuccess">请再次输入密码</label>
			  		 </div>
			  		 <div class="form-group has-warning">
			  		  手机号:
			  		 <input type="text" class="form-control"  name="phone" id="inputError">
			  		 <label class="control-label" for="inputSuccess">注册手机号,用于找回密码(必填)</label>
			  		 </div>
			  		 <div class="form-group has-warning">
			  		 邮  箱:
			  		  <input type="text" class="form-control" name="email"  id="inputError">
			  		  <input type="hidden" name="created_at" id="password" value="{{time()}}">
			  		   <label class="control-label" for="inputSuccess">请输入邮箱正规格式</label>
			  		 </div>
			  		 <button type="" class="btn btn-default">注册</button>
			  		</form> 	
		    	<!-- 登陆表单 结束 -->
		    </div>
		    <div class="col-xs-6 col-md-4"></div>
		</div>		      		
</div>				       
	<!-- 表单验证 -->
	<script type="text/javascript">
	$(window).load(function() {
	    var theWindow = $(window);
	    var $bg = $('#bg');
	    var aspectRatio = $bg.width() / $bg.height();

	    function resizeBg() {
	        if(theWindow.width() / theWindow.height() < aspectRatio) {
	            $bg
	                .removeClass()
	                .addClass('bgheight');
	        } else {
	            $bg
	                .removeClass()
	                .addClass('bgwidth');
	        }
	    }

	    theWindow.resize(resizeBg).trigger('resize');
	});
		//全局变量
		var UserisOk = true;
		var PassisOk = true;
		var RePassisOk = true;
		var EmailisOk = true;
		var PhoneisOK = true;

		//绑定表单提交事件
		$('#zhuce').submit(function(){
			//触发所有的丧失焦点事件
			$('input').trigger('blur');

			//检测所有字段是否正确
			if(UserisOk && PassisOk && RePassisOk && EmailisOk &&PhoneisOK){
				// alert(ok);
				return true;
			}else{
				//阻止默认行为
				return false;
			}
		})


		//给所有的输入框 绑定 获取焦点事件 展示提示信息
		$('input').focus(function(){
			$('.control-label').show();
		})


		//用户名绑定丧失焦点事件
		$('input[name=username]').blur(function(){
			if($(this).val() != '' && $(this).val().length >= 6 && $(this).val().length <= 18){
				//发送ajax去验证用户名是否存在

				var inp = $(this);
				$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
				});
				$.ajax({
					url:'/Home/User/ajax',
					data:{username:inp.val()},
					type:'post',
					// dataType:'json',
					success:function(data){
						if(data =='0'){
							inp.parents('div').find('#user').html('用户名已存在,请更换').css('color','red');
							UserisOk = false;
							
						}else{
							inp.parents('div').find('#user').html('√').css('color','green');
							UserisOk = true;
							
						}
					},
					async:false
				})
				
			    }else{
						$(this).parents('div').find('#user').html('用户名不合法,请输入6-18位用户名').css('color','red');
						UserisOk = false;
						
				}
		})


		//密码验证
		$('input[name=password]').blur(function(){
			var reg = /^\w{6,18}$/;
			if(reg.test($(this).val())){
				PassisOk = true;
				$(this).parents('.form-group').removeClass('has-warning').addClass('has-success').find('label').html('ok!ok!ok!');
			}else{
				$(this).parents('.form-group').removeClass('has-warning').addClass('has-error').find('label').html('密码不符合要求');
				PassisOk = false;
			}
		})

		//确认密码验证
		$('input[name=repassword]').blur(function(){
			var reg = /^\w{6,18}$/;
			var pass = $('input[name=repassword]').val();
			if(reg.test($(this).val()) && $(this).val() == pass){
				$(this).parents('.form-group').removeClass('has-warning').addClass('has-success').find('label').html('ok!ok!ok!');
				RePassisOk = true;
			}else{
				$(this).parents('.form-group').removeClass('has-warning').addClass('has-error').find('label').html('两次密码不符合要求');
				RePassisOk = false;
			}
		})


		//邮箱
		$('input[name=email]').blur(function(){
			var reg = /^\w+@\w+\.(com|cn|net|org)$/;
			if(reg.test($(this).val())){
				EmailisOk = true;
				$(this).parents('.form-group').removeClass('has-warning').addClass('has-success').find('label').html('ok!ok!ok!');
			}else{
				$(this).parents('.form-group').removeClass('has-warning').addClass('has-error').find('label').html('邮箱格式不正确');
				EmailisOk = false;
			}
		})

		//手机号验证
		$('input[name=phone]').blur(function(){
			var reg = /^1[3|4|7|5|8][0-9]\d{4,8}$/;
			if(reg.test($(this).val())){
				PhoneisOk = true;
				$(this).parents('.form-group').removeClass('has-warning').addClass('has-success').find('label').html('ok!ok!ok!');
			}else{
				$(this).parents('.form-group').removeClass('has-warning').addClass('has-error').find('label').html('手机格式不正确');
				PhoneisOk = false;
			}
		})
	</script>
				
			       
			       
			
@endsection
