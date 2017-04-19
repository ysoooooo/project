<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class TongzhiController extends Controller
{
	// 消息列表页 开始
		public function getList(Request $request)
		{
			// 获取数据 ，用户的ID，查询消息数据
				$id=$request->input('id');
				$data=DB::table('tongzhi')->where('s_id',$id)->get();
			// 带数据返回视图
				if($data)
				{
					return view('Home.Tongzhi.list',['data'=>$data]);
				}else
				{
					return redirect()->back()->with('success','您还没有消息');
				}	
				
		}
	// 消息列表页 结束

	// 消息详情页 开始
		public function getSee(Request $request)
		{
			// 获取该条信息的ID，查询详情
				$id=$request->input('id');
				DB::table('tongzhi')->where('id',$id)->update(['dufou'=>'1']);
				$data=DB::table('tongzhi')->where('id',$id)->first();
			// 带数据返回视图
				return view('Home.Tongzhi.see',['data'=>$data]);
		
		}
	// 消息详情页 结束

	// 消息删除 开始
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
	// 消息删除 结束

	// 消息回复 开始
		public function postReply(Request $request)
		{
			// 获取数据
				$data=$request->except('_token');
				$data['f_id']=session('qid');
				$data['f_name']=session('qname');
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
	// 消息回复 结束
}
