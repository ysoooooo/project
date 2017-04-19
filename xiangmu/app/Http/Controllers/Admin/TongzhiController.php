<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;


class TongzhiController extends Controller
{
    // 后台管理消息列表页 开始
        public function getList(Request $request)
        {
             $num = $request->input('num') ? $request->input('num') : 5;
            // 数据库获取数据 返回视图
                $data=DB::table('tongzhi')->paginate($num); 
                return view('Admin.Tongzhi.list',['data'=>$data,'page' => $request->all()]);
        }
    // 后台管理消息列表页 结束

    // 后台管理消息详情页 开始
        public function getDetail(Request $request)
        {
            // 获取该条信息的ID，查询详情
                $id=$request->input('id');
                $data=DB::table('tongzhi')->where('id',$id)->first();
            // 带数据返回视图
                return view('Admin.Tongzhi.detail',['data'=>$data]);
        
        }
    // 后台管理消息详情页 结束

    // 后台管理消息删除 开始
        public function getDelete(Request $request)
        {
            // 获取该条信息的ID，查询详情
                $id=$request->input('id');
                $res=DB::table('tongzhi')->where('id',$id)->delete();
                if($res)
                {
                    return redirect()->back()->with('success','删除成功');
                }else
                {
                    return redirect()->back()->with('error','删除失败');
                }
        }
    // 后台管理消息删除 结束

    // 后台管理消息回复 开始
        public function postReply(Request $request)
        {
            // 获取数据
                $data=$request->except('_token');
                $data['f_id']=session('hid');
                $data['f_name']='管理员通知';
                $data['regdate']=time();
            //插入通知表
                $res=DB::table('tongzhi')->insert($data);
                if($res)
                {
                    return redirect()->back()->with('success','回复成功');
                }else{
                    return redirect()->back()->with('error','回复失败');
                }
        }
    // 后台管理消息回复 结束
}