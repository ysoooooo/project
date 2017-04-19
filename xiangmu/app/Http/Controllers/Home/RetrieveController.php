<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Ucpaas;
use Session;

class RetrieveController extends Controller
{
    /**
     *   解析找回密码页的方法
     *   App\Http\Controllers\Home   
     */
    public function getRetrieve(Request $request)
    {
        return view('/Home.User.retrieve');
    }

    /**
     *   解析填写密码页的方法
     *   $phone 表单手机号的请求获取
     *   带参数$phone返回
     */
    public function postRetrievepass(Request $request)
    {
        $phone = $request->input('phoneh');
        return view('/Home.User.retrievepass', ['phone' => $phone]);
    }

    /**
     *   验证手机号是否注册的方法
     *   $phone 表单手机号的请求获取
     *
     */
    public function postTel()
    {

        $phone = $_POST['phone'];
        $res = DB::table('user')->where('phone', '=', $phone)->get();
        if ($res) {
            return 'ok';
        } else {
            return '该手机号未注册';

        }
    }

    /**
     *  将更新数据插入数据库的方法
     *
     */
    public function postRetrieve(Request $request)
    {

        // 获取数据
        $res = $request->except('_token', 'repassword');
        $password = $res['password'];
        $phone = $res['phone'];

        // 进行密码加密
        $password = Hash::make($password);
        $res['password'] = $password;
        //修改数据，返回受影响行数
        $num = DB::table('user')->where(['phone' => $phone])->update($res);

        //进行判断操作
        if ($num) {
            return redirect('/')->with('success', '恭喜！密码找回...快去登录');
        } else {
            return redirect()->back();
        }

    }

    /**
     *   解析到修改密码页的方法
     *
     */
    public function getRetrievepass(Request $request)
    {
        return view('/Home.User.retrievepass');
    }

    /**
     *   发送验证码的方法
     *   $phone 表单手机号的请求获取
     *   $code  将发送验证码存入session
     */
    public function postCode(Request $request)
    {
        $phone = $request->input('phone');
        //初始化必填
        $options['accountsid'] = '2f206e083e6e317343150aebf4ef5264';
        $options['token'] = '77b9820a76c241293e28c80900a83738';

        //初始化 $options必填
        $ucpass = new Ucpaas($options);

        //开发者账号信息查询默认为json或xml
        $ucpass->getDevinfo('json');

        $appId = "c860845fd5ec4a0aa1eafb35e2c537ba";
        $to = $phone;
        $templateId = "41107";
        $code = rand(10000, 99999);
        $param = $code;
        session(['ucode' => $code]);
        $ucpass->templateSMS($appId, $to, $templateId, $param);

    }

    /**
     *   验证码ajax方法验证
     *   @$ucode 获取的验证码存储的session值
     *   @$code  表单提交的请求验证码
     *
     **/

    public function postYcode(Request $request)
    {
        $ucode = session('ucode');
        $code = $request->only('code');
        if ($code['code'] == $ucode) {
            echo true;
        } else {
            echo false;
        }
    }
}