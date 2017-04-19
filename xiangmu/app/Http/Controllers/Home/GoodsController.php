<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request; 

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

// 导入 Intervention Image Manager Class
use Intervention\Image\ImageManager;

class GoodsController extends Controller
{
	// 发布商品表单页面 开始
		public function getShow(Request $request)
		{
			// 获取分类表的所有数据
				$cate=DB::table('cate')->where('pid','!=','0')->get();
			// 判断是否有鱼塘ID 结果带视图返回数据
				if($request->input('t_id'))
				{
					$p_id=DB::table('cate')->where('name',$request->input('p_name'))->first()->id;
					return view('Home.Goods.show',['cate'=>$cate,'t_id'=>$request->input('t_id'),
						'p_name'=>$request->input('p_name'),'p_id'=>$p_id]);
				}else
		     	{
		    		return view('Home.Goods.show',['cate'=>$cate]);
		    	}
		}
	// 发布商品表单页面 结束

	// 网站发布商品表单提交 开始
		public function postInsert(Request $request)
		{
		//获取要插入商品表的数据
			$res=$request->except('_token','pic');
		//插入商品表，然后得到商品ID
			$num=DB::table('goods')->insertGetId($res);
		//插入商品图片表 多文件
			if($request->hasFile('pic')){
			    foreach($request->file('pic') as $file) 
			    {
			    	// 上传文件之后的文件名
			    		$name = md5(time()+rand(1,999999));
			    	// 获取后缀名，判断格式
		    			$suffix = $file->getClientOriginalExtension();
		    			$arr = ['png','jpeg','gif','jpg'];
		    			if(!in_array($suffix,$arr)){
		    	    		return back()->with('error','上传文件格式不正确');
		    			}
		    		//执行文件上传 
			        	$file->move('./uploads/', $name.'.'.$suffix);
			        	// 通过指定 driver 来创建一个 image manager 实例
			        	$manager = new ImageManager(array('driver' => 'gd'));

			        	// 最后创建 image 实例
			        	$image = $manager->make('uploads/'.$name.'.'.$suffix)->resize(350,420);

			        	// 将处理后的图片重新保存到其他路径
			        	$image->save('goods/'.$name.'.'.$suffix);
		    		//执行数据库图片添加 
				        $vv['goods_id']=$num;$vv['pic']=$name.'.'.$suffix;
				        $k=DB::table('picture')->insert($vv);
			    }
			}
		//判断是否发布成功
			if($num && $k)
			{
				return redirect()->back()->with('success','发布成功');
			}
				

		}
	// 网站发布商品表单提交 结束

	// 查看商品详情信息 开始
		public function getDetail(Request $request)
		{
			// 获取数据：商品的ID
				$id=$request->input('id');
			// 根据商品id获取该商品的点赞数
				$dianzan=DB::table('dianzan')
					->where('pid',$id)
					->count();
				$uid = session('qid');
			// 获取用户是否点赞
				$dianz=DB::table('dianzan')
						->where('pid',$id)
						->where('uid',$uid)
						->get();
				if (!empty($dianz)) {
					$res = 1;
				}else{
					$res = 0;
				}
			// 获取分页信息
        		$num=$request->input('num')?$request->input('num'):5;
			
			// 通过商品的ID查找商品的具体信息
				$goods=DB::table('goods')->where('id',$id)->first();
			// 通过商品的所属者id查找用户的信息 
				$user=DB::table('user')->where('id',$goods->s_id)->first();
			// 在图片表中查找该商品的图片
				$pic=DB::table('picture')->where('goods_id',$id)->get();
			// 通过商品ID查询关于此商品的评论
				$talk=DB::table('talk_goods')->where('productid',$id)->where('status','=','1')->paginate($num);
			// 通过商品鱼塘ID查询鱼塘的信息
				$fish=DB::table('fishs')->where('id',$goods->t_id)->first();
				if($fish)
				{
					// 带数据返回视图 
					return view('/Home/Goods/goodsdetail',['goods'=>$goods,'fish'=>$fish,'user'=>$user,'res'=>$res,'dianzan'=>$dianzan,'pic'=>$pic,'talk'=>$talk,'page'=>$request->all()]);
				}else
				{
					// 带数据返回视图 
					return view('/Home/Goods/goodsdetail',['goods'=>$goods,'user'=>$user,'res'=>$res,'dianzan'=>$dianzan,'pic'=>$pic,'talk'=>$talk,'page'=>$request->all()]);
				}	
			
		}
	// 查看商品详情信息 结束
	
	// 精品发布列表页 开始
		public function getIndex(Request $request)
		{
			// 获取id  name
				$id=$request->id;
				$name=$request->name;
			// 获取父级类型
				$r=DB::table('cate')->where('id',$id)->first();
				$pname=DB::table('cate')->where('id',$r->pid)->first()->name;
		 	$arr = DB::table('cate')
	      // 首先根据类别的id获取该类中的所有商品
	        ->rightJoin('goods', 'cate.id', '=', 'goods.p_id')
	        ->where('goods.p_id','=',$id)
	        ->where('b_id','=','0')
	        ->get();
	        $a=[];    
	        // 遍历商品  链接图片表 获取商品图片的信息
	        foreach ($arr as $k => $v) {
	        // 读取图片
	      	  $arrtupian=DB::table('picture')->where('goods_id',$v->id)->first();
	        // 将图片表在重新组建成一个数组
	      	  array_push($a,$arrtupian);
	    	}
	  	    // 传递给视图
	        return view('Home.Goods.index',['arr'=>$arr,'name'=>$name,'a'=>$a,'pname'=>$pname]);
		}         
	// 精品发布列表页 结束

	// 选择地址页 开始
		public function getXuanzedizhiye(Request $request)
		{
			// 获取数据 商品的ID和购买者的ID
				$goods_id=$request->input('goods_id');
				$uid=session('qid');
			// 查询收货地址
				$data=DB::table('shou_address')->where('uid',$uid)->get();
				if($data){
					return view('Home.Goods.xuanzedizhiye',['data'=>$data,'goods_id'=>$goods_id]);
				}else{
					return redirect()->back()->with('error','您还没有添加收货地址，请前去个人中心填写');
				}
			
		}
	// 选择地址页 结束

	// 确定交易页 开始
		public function getQuedingjiaoyiye(Request $request)
		{
			// 获取数据，商品的ID
				$goods_id=$request->input('goods_id');
				$data=DB::table('goods')->where('id',$goods_id)->first();
			// 查询商品信息，传输数据到视图
				$data->shou_address=$request->input('shou_address');
				$data->shouname=$request->input('shouname');
				$data->shoutelphone=$request->input('shoutelphone');
				return view('Home.Goods.quedingjiaoyiye',['data'=>$data]);
		}
	// 确定交易页 结束

	// 提交订单后 开始
		public function getDoqueding(Request $request)
		{
				$uid=session('qid');
			// 获取数据
				$data['goodsid']=$request->input('goods_id');
				$data['address']=$request->input('shou_address');
				$data['shouname']=$request->input('shouname');
				$data['telphone']=$request->input('shoutelphone');
				$data['numbers']=rand(10000,99999);
				$data['ordertime']=time();
				$data['goumaiid']=$uid;
					// 获取商品信息
					$goods=DB::table('goods')->where('id',$data['goodsid'])->first();
				$data['xiaoshouid']=$goods->s_id;	
			// 插入order表
				$res=DB::table('order')->insert($data);

			// 插入通知表的信息
				$dat['s_id']=$data['xiaoshouid'];
				$dat['f_name']='系统通知';
				$dat['s_name']=DB::table('user')->where('id',$dat['s_id'])->first()->username;
				$dat['regdate']=time();
				$dat['content']='您好:'.$data['shouname'].'预定了您发布的 '.$goods->goodsname.' 请注意付款消息';
			//执行插入通知表
			    $num=DB::table('tongzhi')->insert($dat);
			    if($num)
			    {
			    	return redirect('/')->with('success','提交订单成功！');
			    }else
			    {
			    	return redirect('/')->with('error','提交订单失败');
			    }	
		}
	// 提交订单后 结束

	// 商品点赞 开始
		public function postDianzanshu(Request $request)
		{
			// dd($request->all());
			$uid = session('qid');
			$id=$request->input('id');
			// dd($id);
			$ress=DB::table('dianzan')->insert(['pid'=>$id,'uid'=>$uid]);
			// dd($res,$ress);
			$dianzanshu=DB::table('dianzan')
					->where('pid',$id)
					->count();

			if($ress)
			{
				echo $dianzanshu;
			}else
			{
				echo  '0';
			}
		} 
	// 商品点赞 结束

	// 商品取消点赞 开始
		public function postQuxiaodianzan(Request $request)
		{
			$uid = session('qid');
			$id=$request->input('id');

			$ress=DB::table('dianzan')
				->where('pid',$id)
				->where('uid',$uid)
				->delete();
			$dianzanshu=DB::table('dianzan')
					->where('pid',$id)
					->count();
			if($ress)
			{
				return $dianzanshu;
			}else
			{
				return 0;
			}
		} 
	// 商品取消点赞 结束
}

?>