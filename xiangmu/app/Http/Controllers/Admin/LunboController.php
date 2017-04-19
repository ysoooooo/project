<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\UserPostRequest;

class LunboController extends Controller
{
    //后台查询开始
    public function getIndex(Request $request)
     {
        // 查询信息
        $res = DB::table('lunbotu')
            ->join('cate','lunbotu.cate_id','=','cate.id')
            ->select('lunbotu.*','cate.name')
            ->get();
        return view('Admin.Lunbo.index',['res'=>$res]);
     }
     //后台查询结束

    //修改操作开始
    public function getEdit(Request $request)
    {   
        //获取id
        $id = $request->input('id');

        //查询信息
        $cate = DB::table('cate')->where('pid', '!=', '0')->get();
        $res = DB::table('lunbotu')->where('id',$id)->first();

        //解析模板 分配数据
        return view('Admin.Lunbo.edit',['res'=>$res,'cate' => $cate,'id'=>$id]);
    }

    //执行轮播图修改
    public function postUpdate(Request $request)
    {
        //提取数据 轮播图的id
            $id = $request->input("id");
        //要修改的类型 
            $data['cate_id'] = $request->input('cate_id');
        // 要修改的图片
            $data['pic']=$request->only('pic');
        // 原图
            $oldpic=$request->input('old_pic');
          if (empty($data['pic']))
          {
              $data['pic']=$oldpic;
          }else
          {
              unlink('./config/'.$oldpic);
           
              $data['pic'] = self::upload($request,'pic');
          }
        //数据库修改
        $res = DB::table('lunbotu')->where('id',$id)->update($data);

        if($res)
        {
            return redirect('Admin/Lunbo/index')->with('success','修改成功');
        }else{
            return back()->withInput()->with('error','修改失败');
        }
    }
    //修改操作结束
 
    // 文件上传函数 开始
        static public function upload($request, $picname)
        {
            //判断是否有文件上传catelist
            if ($request->hasFile($picname))
            {
                //随机文件名
                $name = time().rand(1, 999999);
                //获取文件的后缀名
                $suffix = $request->file($picname)->getClientOriginalExtension();
                $arr = ['png', 'jpeg', 'gif', 'jpg'];
                if (!in_array($suffix, $arr))
                {
                    return back()->with('error', '上传文件格式不正确');
                }
                $request->file($picname)->move('./config/',$name.'.'.$suffix);
                //返回路径
                return $name.'.'.$suffix;
            }
        }
    // 文件上传函数 结束
}



  