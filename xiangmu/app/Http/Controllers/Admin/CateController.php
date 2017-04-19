<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Http\Requests\UserPostRequest;


class CateController extends Controller
{
  // 后台添加分类 开始
    public function add(Request $request)
    {

      // 判断请求方式，如果为get请求 分配数据展示分类页面 开始
  	  	if($request->method()=='GET')
        {
          // 查询数据
  	  		  $res=DB::table('cate')->get();
          // 返回视图
  	  		  return view('Admin.Cate.add',['res'=>$res]);
  	  	}
      // 判断请求方式，如果为get请求 分配数据展示分类页面 结束

      // 判断请求方式，如果为post请求 获取数据添加操作 开始
  	  	if($request->method()=='POST'){
          // 获取数据
  	  		  $res=$request->except('_token');
          // 判断
    	  		if($res['pid']==0)
            {
    	  			$res['path']=0;
    	  		}else
            {
      	  		$p=DB::table('cate')->where('id',$res['pid'])->first();
      	  		$path= $p->path.','.$res['pid'];
      	  		$res['path']=$path;
    	  	  }
          //添加数据到数据库 
  	  		  $num=DB::table('cate')->insert($res);
          //判断如果成功，返回分类页面 
  	  		  if($num)
            {
  	  		    return redirect('Admin/Cate/index');
  	  	    }
  	    }
      // 判断请求方式，如果为post请求 获取数据添加操作 结束
    }
  // 后台添加分类 结束

  // 后台分类首页展示 开始
    public function index()
    {
      	// 查询数据
      	  $res=DB::select('select *,concat(path,",",id) as a from cate order by a');
      	// 分配数据到视图
      	  return view('Admin.Cate.index',['res'=>$res]);
    }
  // 后台分类首页展示 结束

  // 后台ajax分类删除 开始
    public function delete(Request $request)
    {
      // 获取要删除的ID
      	$id=$request->input('id');
      // 查询分类是否有子分类
      	$res=DB::table('cate')->where('pid',$id)->get();
      //查询分类下是否有商品
        $arr=DB::table('goods')->where('p_id',$id)->get();
      // 判断，返回结果到ajax.有数据的分类不允许删除
      	if(empty($res) && empty($arr))
        {
          // 执行删除操作
      		  $num=DB::table('cate')->where('id',$id)->delete();
      	      echo $num;
      	}else
        {
      		echo 0;
      	}
    	
    }
  // 后台ajax分类删除 结束
    
  // 后台ajax分类修改 开始
    public function edit(Request $request)
    {
      // 获取数据，要修改的ID
        $id=$request->input('id');
      //获取修改的分类名称 
        $name=$request->input('name');
      //执行操作 
        $num=DB::table('cate')->where('id',$id)->update(['name'=>$name]);
      //返回数据到ajax 
        if($num)
        {
          echo 1;
        }else{
          echo 0;
        }
    }
  // 后台ajax分类修改 结束
}

