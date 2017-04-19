<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class FishController extends Controller
{
	//鱼塘塘主首页 开始
		public function getIndex(Request $request)
		{
		    //获取鱼塘塘主的ID
		    	$id=session('qid');
		   
		    //通过鱼塘塘主的ID查询所属鱼塘的信息 (鱼塘信息$arr)
				$arr=DB::table('fishs')->where('tz_id',$id)->first();

			 // 通过鱼塘的ID查询成员数量
				$member=DB::table('fishmember')->where('fish_id',$arr->id)->count();		
			//获取鱼塘所属类型
				$cate=DB::table('cate')->where('id',$arr->cate_id)->first(); 
			//联查商品和用户表的信息
				$goods = DB::table('goods')
	                	->join('user','goods.s_id','=','user.id')
	                	->select('goods.*','user.username','user.pic','user.id as aa')
	                	->where('goods.t_id','=',$arr->id)
	                	->where('goods.b_id','=','0')
	                	->orderby('goods.id','desc')
	                	->get();

               	$piclist=DB::table('picture')->get();

               	foreach($piclist as $pk => $pv)
               	{
               		foreach ($goods as $gk=> $gv)
               		{
               			if($pv->goods_id==$gv->id)
               			{
               				$gv->pic_arr[]=$pv;
               			}
               		}
               	}

			//带数据展现视图
				return view('Home.Fish.myfish',['arr'=>$arr,'goods'=>$goods,'cate'=>$cate,'member'=>$member]);
								
		}
	//鱼塘塘主首页 结束

	//鱼塘分类入口，鱼塘列表 开始 
		public function getCate(Request $request)
		{
			//获取鱼塘所属类型ID和鱼塘名称
				$id=$request->input('id');
				$name=$request->input('name');
			//获取主类型
				$r=DB::table('cate')->where('id',$id)->first();
				$pname=DB::table('cate')->where('id',$r->pid)->first()->name; 
		    //通过类型ID查询所有鱼塘


		        $arr=DB::table('fishs')->where('cate_id',$id)->get();
		    //带数据返回视图 
				return view('Home.Fish.cate',['name'=>$name,'arr'=>$arr,'pname'=>$pname]);
		}
	//鱼塘分类入口，鱼塘列表 结束

	//鱼塘详情入口 开始
		public function getDetail(Request $request)
		{
			// 获取上一页面的所有信息 鱼塘所属的父类别子类别 
				$all=$request->all();
			// 获取鱼塘的ID
				$id=$request->input('id');
			// 通过鱼塘的ID查询成员数量
				$member=DB::table('fishmember')->where('fish_id',$id)->count();
		    // 通过鱼塘的ID获取鱼塘的基本信息 一个一维数组
		    	$fish=DB::table('fishs')->where('id',$id)->first();
		    	$cate=DB::table('cate')->where('id',$fish->cate_id)->first();
		    // 获取鱼塘塘主的信息
		    	if($fish->tz_id)
		    	{
		    		$tz_name=DB::table('user')->where('id',$fish->tz_id)->first()->username;
		    	}else
		    	{
		    		$tz_name=null;
		    	}
		    // 判断是否为塘主进入自己鱼塘
		    	if(session()->has('qid') && $fish->tz_id==session('qid'))
		    	{
		    		return redirect('/Home/Fish/index');
		    	}
		    // 通过鱼塘的ID查找属于该鱼塘的商品和用户的相关信息 商品的图片信息

		    	$goods = DB::table('goods')
                	->join('user','goods.s_id','=','user.id')
                	->select('goods.*','user.username','user.pic','user.id as aa')
                	->where('goods.t_id','=',$id)
                	->where('goods.b_id','=','0')
                	->orderby('goods.id','desc')
                	->get();

               	$piclist=DB::table('picture')->get();

               	foreach($piclist as $pk => $pv)
               	{
               		foreach ($goods as $gk=> $gv)
               		{
               			if($pv->goods_id==$gv->id)
               			{
               				$gv->pic_arr[]=$pv;
               			}
               		}
               	}
              
		    // 查询用户是否加入鱼塘
		    	if(session()->has('qid'))
		    	{
		    		$num=DB::table('fishmember')->where('member_id',session('qid'))->where('fish_id',$id)->first();
		    		if(!empty($num))
		    		{
		    			// 如果已加入，多返回一个数据
		    			return view('Home.Fish.detail',['all'=>$all,'fish'=>$fish,
		    				'goods'=>$goods,'num'=>$num,'tz_name'=>$tz_name,'cate'=>$cate,'member'=>$member]);
		    		}		
		    	}	
		    // 所有数据传入视图，展现
		    	return view('Home.Fish.detail',['all'=>$all,'fish'=>$fish,
		    		'goods'=>$goods,'tz_name'=>$tz_name,'member'=>$member]);
		       
		} 
	//鱼塘详情入口 结束

	//用户加入鱼塘 开始
		public function getJoin(Request $request)
		{
			//获取数据：用户的ID和要加入鱼塘的ID 
				$uid=$request->input('uid');
				$fid=$request->input('fid');
			//加入鱼塘
				$num=DB::table('fishmember')->insert(['member_id'=>$uid,'fish_id'=>$fid]);
				if($num)
				{
					return redirect()->back()->with('success','加入鱼塘成功！');		  
				}		
		}
	//用户加入鱼塘 结束

	// 用户退出鱼塘 开始
		public function getTuichu(Request $request)
		{
			//获取数据：用户的ID和要加入鱼塘的ID 
				$uid=$request->input('uid');
				$fid=$request->input('fid');

			//加入鱼塘
				$num=DB::table('fishmember')->where('member_id',$uid)->where('fish_id',$fid)->delete();
				if($num)
				{
					return redirect()->back()->with('success','退出鱼塘成功！');		  
				}		
		}
	// 用户退出鱼塘 结束

	//用户申请鱼塘塘主 开始
		public function getShenqing(Request $request)
		{
			//获取数据：用户的ID和要申请鱼塘的ID 

				$data=$request->all();
				$data['time']=time();

				// dd($data);
				$res=DB::table('shenqing')->where('user_id',$data['user_id'])->where('fish_id',$data['fish_id'])->first();
				if($res)
				{
					return redirect()->back()->with('error','你已经申请过了，不要重复申请');
				}

				$res=DB::table('fishs')->where('tz_id',$data['user_id'])->first();
				if($res)
				{
					return redirect()->back()->with('error','你已经是个塘主了，不能太贪心呀');
				}
			//加入鱼塘
				$res=DB::table('shenqing')->insert($data);
				if($res)
				{
					return redirect()->back()->with('success','申请成功，等待管理员审核');
				}else
				{
					return redirect()->back()->with('error','操作失败');
				}	
				
		}
	//用户申请鱼塘塘主 结束

	// 鱼塘的发布商品数ajax 开始
		public function postNum(Request $request)
		{
			// 获取数据，鱼塘的ID
				$id=$request->input('num');
			// 通过鱼塘ID统计发布于此鱼塘的商品数量
				$num=DB::table('goods')->where('t_id',$id)->count();
				if($num)
				{
					echo $num;
				}else
				{
					echo 0;
				}
		}
	// 鱼塘的发布商品数ajax 结束
}