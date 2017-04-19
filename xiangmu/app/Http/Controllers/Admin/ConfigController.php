<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class ConfigController extends Controller
{
	//后台查询开始
	public function getIndex(Request $request)
	{
        //查询信息
	   $res = DB::table('configure')->get();
	   
       //返回视图
	   return view('Admin.Config.index',['res'=>$res]);
	}
    //后台查询结束

	//后台修改开始
    public function getEdit(Request $request)
    {
        //获取id
        $id = $request->input('id');

        //查询信息
        $res = DB::table('configure')->where('id',$id)->first();

        //解析模板 分配数据
        return view('Admin.Config.edit',['res'=>$res]);
    }

    //后台执行修改
    public function postUpdate(Request $request)
    {
        //分开提取数据
        $data = $request->except('_token');

        //调用上传方法 
        $data['logo'] = self::uploads($request);

        //查询信息
        $res = DB::table('configure')->where('id',$data['id'])->update($data);

        //对查询的信息进行判断
        if($res)
        {
            return redirect('Admin/Config/index')->with('success','修改成功');
        }else{
            return back()->withInput()->with('error','修改失败');
        }
    }
    // 后台修改接收
    
    //图片上传开始
    public function uploads($request)
    {
        //判断是否有文件上传
        if($request->hasFile('logo')){

            //随机文件名
            $name = md5(time()+rand(1,999999));

            //获取文件的后缀名
            $suffix = $request->file('logo')->getClientOriginalExtension();
            $arr = ['png','jpeg','gif','jpg'];

            //对文件格式进行判断
            if(!in_array($suffix,$arr)){
                return back()->with('error','上传文件格式不正确');
            }

            //移动图片
            $request->file('logo')->move('./config/', $name.'.'.$suffix);

            //返回路径
            return $name.'.'.$suffix;

        };  
      }
    //图片上传结束
}

