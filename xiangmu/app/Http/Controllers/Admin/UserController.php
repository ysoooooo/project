<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Http\Requests\UserPostRequest;



class UserController extends Controller
{
    //后台用户列表 开始
        public function getIndex(Request $request)
        {
            // 获取分页信息和关键字
            $num = $request->input('num') ? $request->input('num') : 5;
            $keyword = $request->input('keyword') ? $request->input('keyword') : '';
            //判断搜索关键字是否为空
            if (empty($keyword)) {
                $users = DB::table('user')->paginate($num);
            } else {
                $users = DB::table('user')->where('username', 'like', '%' . $keyword . '%')->paginate($num);
            }
            //遍历权限，重新赋值
            foreach ($users as $key => $v) 
            {
                switch ($v->auth)
                {
                    case '1':
                        $v->auth = '普通用户';
                        break;
                    case '2':
                        $v->auth = '鱼塘塘主';
                        break;
                    case '3':
                        $v->auth = '管理员';
                        break;
                    case '4':
                        $v->auth = '超级管理员';
                        break;
                }
            }
            //带参数返回视图
            return view('/Admin.User.index', ['users' => $users, 'page' => $request->all()]);

        }
    //后台用户列表 结束

    //后台用户添加页面展示 开始
        public function getAdd()
        {
            return view('/Admin.User.add');
        }
    //后台用户添加页面展示 结束

    //后台用户添加ajax验证 开始
        public function postAjax(Request $request)
        {
            $name = $request->input('username');
            $res = DB::table('user')->where(['username' => $name])->get();
            if (empty($res)) {
                echo 1;
            } else {
                echo 0;
            }
        }
    //后台用户添加ajax验证 结束

    //后台用户添加操作 开始
        public function postInsert(Request $request)
        {
            //后台用户添加验证 开始
                $this->validate($request, [
                    'username' => 'required|min:6|max:18',
                    'password' => 'required|integer',
                ], [
                    'required' => ':attribute为必填项（必选项）',
                    'min' => ':attribute长度不符合要求',
                    'integer' => ':attribute必须为整数',
                ], [
                    'username' => '用户名',
                    'password' => '密码',
                ]);
            //后台用户添加验证 结束

            //后台用户添加获取数据
                $res = $request->except('_token');
            //密码加密 
                $res['password'] = Hash::make($res['password']);
            //判断是否上传头像
                if (!empty($res['pic'])) {
                    $res['pic'] = self::upload($request, 'pic');
                }
            //插入数据
                $num = DB::table('user')->insertGetId($res);
            //判断是否插入成功
                if ($num) {
                    // 同时插入用户详情表
                        DB::table('userdetails')->insert(['uid' => $num]);
                    // 插入积分表
                        $time=time();
                        DB::table('integrals')->insert(['uid' => $num,'intertime'=>$time]);
                    return redirect('/Admin/User/index')->with('success', '添加成功');
                } else {
                    return redirect()->back()->with('error', '操作失败');
                }
        }
    //后台用户添加操作 结束

    //后台处理头像上传函数 开始
        static public function upload($request, $picname)
        {
            //判断是否有文件上传
            if ($request->hasFile($picname)) {
                //随机文件名
                $name = md5(time() + rand(1, 999999));
                //获取文件的后缀名
                $suffix = $request->file($picname)->getClientOriginalExtension();
                $arr = ['png', 'jpeg', 'gif', 'jpg'];
                if (!in_array($suffix, $arr)) {
                    return back()->with('error', '上传文件格式不正确');
                }
                $request->file($picname)->move('./uploads/', $name . '.' . $suffix);
                //返回路径
                return $name . '.' . $suffix;
            }
        }
    //后台处理头像上传函数 结束

    //后台ajax用户删除 开始
        public function postDelete(Request $request)
        {
            $id = $request->input('id');
            $res = DB::table('user')->where('id', $id)->delete();
            $res2 = DB::table('userdetails')->where('uid', $id)->delete();
            // $res3 = DB::table('jingjia')->where('uid', $id)->delete();
            echo $res &&$res2　&&$res3;
        }
    //后台ajax用户删除 结束

    //后台用户修改展示页面 开始
        public function getEdit(Request $request)
        {
            //获取数据 要修改的用户ID
            $id = $request->input('id');
            //分别在user和userdetails表中获取数据
            $res = DB::table('user')->where('id', $id)->first();
            $resd = DB::table('userdetails')->where('uid', $id)->first();
            //带数据显示修改页
            return view('/Admin.User.update', ['res' => $res], ['resd' => $resd]);
        }
    //后台用户修改展示页面 结束

    //后台用户修改操作 开始
        public function postUpdate(Request $request)
        {
            //修改验证
            $this->validate($request, [
                'username' => 'required|min:2|max:20',
            ], [
                'required' => ':attribute为必填项',
            ], [
                'username' => '用户名',
            ]);
            //获取用户id
            $id = $request->input('id');
            //获取修改的字段内容
            $res = $request->only('username', 'auth', 'update_at');
            $resd = $request->only('sex', 'uname','address');
            //分别修改两表的内容
            $num = DB::table('user')->where('id', $id)->update($res);

            $numd = DB::table('userdetails')->where('uid', $id)->update($resd);
            //判断修改是否成功
            if ($num && $numd) {
                return redirect('/Admin/User/index')->with('success', '修改成功');
            } else {
                return redirect()->back()->with('error', '修改失败');
            }
        }
    //后台用户修改操作 结束
        
    //后台用户详情页展示 开始
        public function getDetail(Request $request)
        {
            //获取数据要展示的用户id
            $id = $request->input('id');
            //通过ID查询user表中的一条信息
            $res = DB::table('user')->where('id', $id)->first();
            //通过ID查询userdetails表中的一条信息
            $resd = DB::table('userdetails')->where('uid', $id)->first();
            //带数据显示详情页
            return view('Admin.User.detail', ['user' => $res], ['userdetails' => $resd]);
        }
    //后台用户详情页展示 结束

    //后台用户登录处理  开始
        public function login(Request $request)
        {
            // 如果请求方式为post 执行程序 
                if($request->method()=='POST')
                {
                    // 接受数据 开始
                        $username=$request->input('username');
                        $password=$request->input('password');
                        $userInput = \Request::get('captcha');
                    // 判断验证码 是否正确
                        if (\Session::get('code') !== $userInput) {
                             // alert('验证码错误');
                             return redirect()->back()->with('error','验证码错误');
                        }
                    // 接受数据 结束
                    // 判断数据是否为空 开始
                        if(empty($username) || empty($password))
                        {
                            return redirect()->back()->with('error','用户名或密码不能为空');
                        }
                    // 判断数据是否为空 结束

                    // 查询此用户名数据 开始
                        $res = DB::table('user')->where(['username' => $username])->first();
                    // 查询此用户名数据 结束
                    
              
                    // 若用户名数据不存在 error处理 开始
                        if (!$res) {
                            return redirect()->back()->with('error', '用户不存在');
                        }
                    // 若用户名数据不存在 error处理 结束


                    // 用户名存在，判断密码是否正确。 开始
                        if (Hash::check($password, $res->password)) {
                            // 密码正确。存入session。 开始
                                if ($res->auth > 2) {
                                    session(['hid' => $res->id, 'hname' => $res->username, 'hauth' => $res->auth]);
                                    return redirect('/Admin/parent/parent');
                                } else {
                                    return redirect('/Admin/User/login')->with('error', '用户无权限');
                                }
                            // 密码正确。存入session。 结束
                        } else {
                            // 密码错误，error处理 开始
                            return redirect()->back()->with('error', '登录不成功！账号密码不匹配');
                            // 密码错误，error处理 结束
                        }
                    // 用户名存在，判断密码是否正确。 结束
                } else {

                    // 如果方式为get,展示登录页面
                    return view('/Admin.User.login');
                }
               
        }
    //后台用户登录处理  结束
 
    //后台用户退出登录 开始
        public function getLogout()
        {
            //清除session信息
            session()->forget('hid');
            session()->forget('hname');
            //返回登录页面
            return view('/Admin.User.login');
        }
    //后台用户退出登录 结束
}
