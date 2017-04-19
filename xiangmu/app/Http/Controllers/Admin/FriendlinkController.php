<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;


class FriendlinkController extends Controller
{
    //后台查询开始
      public function getIndex(Request $request)
      {
         //每页显示几条
      $num = $request ->input('num',2);
      //判断用户是否搜素
      if($request->input('title'))
      {
        $res = DB::table('friendlink')
          ->where('linkname','like','%'.$request->input('title').'%')
          ->paginate($num);
      }else{
        //查询信息
        $res = DB::table('friendlink')->orderBy('id')->paginate($num);
      }
      $all=$request->all(); 
       //返回视图
        return view('Admin.Friendlink.index',['res'=>$res,'all'=>$all]);
      }
    //后台查询结束

  //添加友情链接页面 开始
    public function getAdd()
    {
      
      //显示友情链接添加表单
      return view('Admin.Friendlink.add');
    }
  

   //form单请求类添加 开始
      public function postInsert(Request $request)
      {  
        //提取数据
        $data = $request->except(['_token']);
        $name = $request->input('linkname');
        $ress = DB::table('friendlink')->where(['linkname'=>$name])->get();

        //查询信息 并判断是否重复
        if(empty($ress))
        {
          $res = DB::table('friendlink')->insertGetId($data);
          return redirect('Admin/Friendlink/index')->with('success','添加成功');   
        }else
        {
          return back()->withInput()->with('error','添加失败');
        }
      }
   //form单请求类添加 结束
  //添加友情链接页面 结束

  //删除操作开始
    public function getDelete(Request $request)
    {
        //接收数据
        $id = $request->input('id');

        //删除
        $res = DB::table('friendlink')->where('id','=',$id)->delete();

        if($res)
        {
          return redirect('Admin/Friendlink/index')->with('success','删除成功');
        }else{
          return redirect('Admin/Friendlink/index')->with('error','删除失败');
        }
    }
  //删除操作结束

  //修改操作开始
    public function getEdit(Request $request)
    {
        $id = $request->input('id');
        //查询用户信息
        $res = DB::table('friendlink')->where('id',$id)->first();

        //解析模板 分配数据
        return view('Admin.Friendlink.edit',['res'=>$res]);
    }

    //执行用户修改
      public function postUpdate(Request $request)
      {
          //提取数据
          $data = $request->except('_token');

          //查询信息
          $res = DB::table('friendlink')->where('id',$data['id'])->update($data);

          if($res)
          {
              return redirect('Admin/Friendlink/index')->with('success','修改成功');
          }else
          {
              return back()->withInput()->with('error','修改失败');
          }
      }
  //修改操作结束
 
     
}



  