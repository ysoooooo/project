<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class TalkController extends Controller
{
	// 商品一级评论 开始
		public function postTalk(Request $request)
		{
			// 获取数据，商品ID和评论内容
				$goodid=$request->input('goodid');
				$con=$request->input('con');
			// 评论层级为1
				$data['lays'] = 1;
			//获取评论者ID 
			    $data['uid'] = $uid = session('qid');
			//通过商品ID ,查询商品名，评论数加一
			    $gid = $goodid;
			    $goodinfo = DB::table('goods')->where('id',$gid)->first();

			    $data['productname'] = $goodinfo -> goodsname;
			    $go['reply'] = $goodinfo -> reply+1;
			//评论的内容 
			    $data['content']  = $con;
			//评论的时间戳 
			    $data['rtime'] = time();
			// 父级ID和商品ID
			    $data['fatherid'] = 0;
			    $data['productid'] = $goodid;
		    // 用户名和用户头像
		        $data['uname'] = session('qname');
		        $data['upic'] = session('qpic');
		    
			    //作品id 根据pid获取作品名
			    $insertid = DB::table('talk_goods') -> insertGetId($data);

			    if($insertid)
			    {
			        $pres = DB::table('goods') -> where('id',$goodid) -> update($go);
			        if($pres)
			        {
			        	
			            echo json_encode(['id'=> $insertid,'uname'=>$data['uname'],'upic'=>$data['upic'],
			            	'utime'=>$data['rtime']]);
			                
			        }else
			        {
			            echo 0;
			        }
			    }else
			    {
			        echo 0;
			    }
		}
	// 商品一级评论 结束
	// 商品评论回复 开始
		public function  postReply(Request $request)
		{
			// 获取数据，商品ID和评论内容 父级ID 和父级评论ID
				$goodsid=$request->input('goodsid');
				$content=$request->input('conten');
				$fatherid=$request->input('fatherid');
			// 获取回复者的姓名和头像
				$data['uname'] = session('qname');
	            $data['upic'] = session('qpic');
			// 用户id 
	        	$data['uid']= session('qid');
	        // 商品ID
	       	 	$data['productid'] = $goodsid;
	        // 商品名称
	        	$data['productname'] = DB::table('goods')->where('id',$goodsid)->first()->goodsname;
	        // 回复评论的内容
	        	$data['content']= $content;
	        // 获取时间戳
	        	$data['rtime'] =$time= time();
	        // 评论的父级ID
	        	$data['fatherid'] =$fatherid;
	        $insertid = DB::table('talk_goods')->insertGetId($data);
	        if($insertid)
	        {
	            
	            $ress = DB::table('talk_goods')->select('lays','uid','uname')->where('id',$fatherid)->first();
	            $update['lays'] = $ress->lays + 1;
	            $update['fuid'] = $ress -> uid;
	            $update['funame'] = $ress -> uname;
	            $res = DB::table('talk_goods') -> where('id',$insertid)-> update($update);
	            if($res)
	            {
	                echo json_encode(['id'=> $insertid,'uname'=>$data['uname'],'rtime'=>$time,
	                    'upic'=>$data['upic'],'lays'=>$update['lays'],'content'=>$data['content'],
	                    'funame'=>$update['funame'],'fuid'=>$update['fuid'],'uid'=>$data['uid']]);

	            }else
	            {
	                echo 0;
	            }
	        }else
	        {
	            echo 0;
	        }
	        exit;
	    }
	// 商品评论回复 结束
}