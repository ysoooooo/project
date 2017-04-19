<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Hash;
// 导入 Intervention Image Manager Class
use Intervention\Image\ImageManager;

class UserController extends Controller
{
    // 前台用户注册 开始
	    public function register(Request $request)
	    {
			// 访问是GET，展示注册页面
				if($request->method()=='GET')
				{
					return view('/Home.User.register');
				}
			// 访问是post，进行注册操作 开始
				if($request->method()=='POST')
				{
					// 获取数据
						$res=$request->except('_token','repassword');
						$password=$res['password'];
					// 进行密码加密
						$password= Hash::make($password);
						$res['password']=$password;
						// dd($res);
					//插入数据，返回受影响行数 
						$uid = DB::table('user')->insertGetId($res);
						// dd($uid);	
						$num=DB::table('userdetails')->insert(['uid'=>$uid]);
					//插入积分表 开始
						$data['integral'] = 100;
						$data['uid'] = $uid;
						$data['intertime'] = time();
						$inter = DB::table('integrals')->insert($data);
					//插入积分表 结束	
					//进行判断操作 
						if($num){
							return redirect('/')->with('success','恭喜！注册成功...快去登录,加积分+100分');
						}else
						{
							return redirect()->back();
						}
				}	
			// 访问是post，进行注册操作 结束
		}
	// 前台用户注册 结束

    // 注册ajax 验证 开始
	    public function ajax(Request $request)
	    {
	        $name = $request->input('username');
	        $res = DB::table('user')->where(['username' => $name])->get();
	        if (empty($res)) {
	            echo 1;
	        } else {
	            echo 0;
	        }
	    }
    // 注册ajax 验证 结束

    // 前台用户 登录处理  开始
	    public function login(Request $request)
	    {
	        // 接受数据 开始
		        $username = $request->input('username');
		        $password = $request->input('password');
	        // 接受数据 结束

	        // 判断数据是否为空 开始
		        if (empty($username) || empty($password)) {
		            return redirect()->back()->with('error', '用户名或密码不能为空');
		        }
	        // 判断数据是否为空 结束

	        // 查询此用户名数据 开始
	        	$res = DB::table('user')->where(['username' => $username])->first();
	        // 查询此用户名数据 结束
	        	if(!$res)
	        	{
	        		return back()->with('error','用户不存在！');
	        	}
			// 用户名存在，判断密码是否正确。 开始
					if(Hash::check($password,$res->password))
					{
						// 密码正确。存入session。 开始
							session(['qid'=>$res->id,'qname'=>$res->username,'qauth'=>$res->auth,'qpic'=>$res->pic]);
							//插入积分表,开始
							$resinter  =DB::table('integrals')->where(['uid' => $res->id])->first();
							$data = $resinter->integral+88;
							$oldtime = $resinter->intertime;
							$time = time();
							$newtime = $time - $oldtime;
							if ($newtime > 200) {
								$inter = DB::table('integrals')->where(['uid' => $res->id])->update(['integral'=>$data,'intertime'=>$time]);
								return redirect('/')->with('success','登录成功！开启买卖之旅,加积分+88');
							}
							//插入积分表,结束
							return redirect('/')->with('success','登录成功！开启买卖之旅');
						// 密码正确。存入session。 结束
					}else
					{
						// 密码错误，error处理 开始
						return redirect()->back()->with('error','登录不成功！账号密码不匹配');
						// 密码错误，error处理 结束
					}
			// 用户名存在，判断密码是否正确。 结束
				
		}
	// 前台用户 登录处理  结束 

	// 编辑资料 开始
		public function postUpd(Request $request)
	 	{	
	 		// 获取id
	 		$id = session('qid');
	 		// 将获取的数据分开 插入到两张表
	    	$data = $request->only(['email','pic']);
	    	//获取图片信息 不要文件夹名跟后缀
	    	$a=$data['pic'];

	    	$aaa = $request->only(['uname','sex','address']);	
	    	// dd($aaa);   
	    	// 获取的图片走 静态方法
	        $data['pic'] = self::upload($request);	
			// 插入user表
			$res= DB::table('user')
			     ->where('id','=',"$id")
	 		     ->update($data);
	 		  // 插入userdetails表
	 		$ress= DB::table('userdetails')
			     ->where('uid','=',"$id")
	 		     ->update($aaa);
			    // dd($ress);  
	 		
	        if($res && $aaa){
	        	
	    		return redirect('/Home/User/userdetail')->with('success','修改成功');
	    	}else{
	    		return back()->with('error','修改失败');
	    	}
	    } 
	// 编辑资料 结束 

	// uoload方法静态  开始
		static public function upload($request)
		{
		// 检测是否有文件上传
			if($request->hasfile('pic')){
				$name = md5(time()+rand(1,999999));
				// 获取文件的后缀名
					$suffix = $request->file('pic')->getClientOriginalExtension();
					$arr = ['png','jpeg','jpg','gif'];
					if(!in_array($suffix,$arr)){
					return back()->with('error','上传文件格式不正确');
					}

				$request->file('pic')->move('./uploads/',$name.'.'.$suffix);
				return $name.'.'.$suffix;
			}
		}
	// uoload方法静态  结束

	// 修改密码开始
		public function postUpdpass(Request $request)
		{
			// 根据session获取id
			$id = session('qid');
			// dd($id);
			// 获取提交过来的密码
			$data = $request->only(['password']);
			$password=$data['password'];
		// 进行密码加密
			$password= Hash::make($password);
			$data['password']=$password;
			// dd($data);
			// 修改
			$newpsss= DB::table('user')
			     ->where('id','=',"$id")
     		     ->update($data);
     		    // dd($newpsss);
     		return redirect('/Home/User/userdetail')->with('success','修改成功'); 

		}
	// 修改密码结束


	// 退出登录开始
		public function getTuichu()
		{
			session()->forget('qid');
			session()->forget('qname');
			session()->forget('qpic');
			session()->forget('qauth');
			return redirect('/');

		}
	// 退出登录结束

	// 原密码验证开始
		public function postYanzheng(Request $request)
		{
			$id = session('qid');
			$oldpass = $request->input('oldpass');
			$res=DB::table('user')->where('id','=',$id)->first();
			if(Hash::check($oldpass,$res->password))
			{
				return 1;
			}else{
				return 0;
			}

		}
	// 原密码验证结束


	// 前台用户个人中心 开始
		public function getUserdetail()
		{
		// 获取用户id
			$id = session('qid');
		// 用户积分查询 开始
			$inter = DB::table('integrals')
	        ->where('uid','=',$id)
	        ->first();
		            if($inter->integral >99 && $inter->integral <500){
		            	$inter->integral = '小蝌蚪';
		            }else if($inter->integral >500 && $inter->integral <1000){
		            	$inter->integral = '小鱼儿';
		            }else if($inter->integral >500 && $inter->integral <1000){
		            	$inter->integral = '大鱼儿';
		            }else if($inter->integral >1000 && $inter->integral <2000){
		            	$inter->integral = '大鲨鱼';
		            }else{
		            	$inter->integral = '小小蝌蚪';
		            }
		// 用户积分查询 结束

		// 查询用户详细信息 开始
			$users = DB::table('user')
	        ->rightJoin('userdetails', 'userdetails.uid', '=', 'user.id')
	        ->where('user.id','=',$id)
	        ->first();	    	   
		// 查询用户详细信息 结束

	    // 查询用户发布的商品 开始
			$usersfabu = DB::table('user')
			->rightJoin('goods', 'goods.s_id', '=', 'user.id')
			->where('user.id',$id)
			->get();
			
			// 查询图片信息
				$usersfabutupian=[];
				foreach ($usersfabu as $k => $v)
				{
					$usertupian = DB::table('picture')->where('goods_id',$v->id)->first();
					array_push($usersfabutupian, $usertupian);
				}
		// 查询用户发布的商品 结束
        
        // 个人中心查看我加入的鱼塘 开始
	    	// 获取用户的ID
	    		$id=session('qid');
	    	// 查询鱼塘成员表和鱼塘名称
	    		$res=DB::table('fishmember')
	    			->join('fishs','fishmember.fish_id','=','fishs.id')
	    			->select('fishmember.*','fishs.t_name','fishs.tz_id')
	    			->where('fishmember.member_id','=',$id)
	    			->get();   
		// 个人中心查看我加入的鱼塘 结束

	    // 个人中心查看我点赞的商品 开始
		    $usersdianzan = DB::table('dianzan')
					->rightJoin('goods','goods.id','=','dianzan.pid')
					->where('dianzan.uid','=',"$id")
					->get();
					//查询用户点赞商品的图片
						$usersdianzantupian=[];
						foreach ($usersdianzan as $k => $v) 
						{
							$usertupian=DB::table('picture')->where('goods_id',$v->id)->first();
							array_push($usersdianzantupian, $usertupian);
						}
			// dd($usersdianzan);					
	    // 个人中心查看我点赞的商品 结束

		// 个人中心查看我关注的人 开始
			$guanzhu=DB::table('guanzhu')
					->join('user','user.id','=','guanzhu.b_id')
					->select('guanzhu.*','user.username')
					->where('g_id',$id)
					->get();			
		// 个人中心查看我关注的人 结束

		// 用户个人中心的被关注数 开始
			$number=DB::table('guanzhu')
					->where('b_id',$id)
					->count();
		// 用户个人中心的被关注数 结束

		// 订单  开始 ！！！！！！
			//  我发布商品的订单信息
	        	$data=DB::table('order')
	        		->join('goods','goods.id','=','order.goodsid')
	        		->join('user','order.goumaiid','=','user.id')
	        		->select('order.*','user.*','goods.*','order.id as orderid')
		        	->where('xiaoshouid',$id)
		        	->get();
		        	
	        // 我购买的商品的订单信息
	        	$datt=DB::table('order')
	        		->join('goods','goods.id','=','order.goodsid')
	        		->join('user','order.xiaoshouid','=','user.id')
		        	->where('goumaiid',$id)
		        	->select('order.*','user.*','goods.*','order.id as orderid')
		        	->get();
	    // 订单  结束 ！！！！！！			
	

		return view('Home.User.userdetail',['res'=>$res,'users'=>$users,
					'usersdianzan'=>$usersdianzan,'usersdianzantupian'=>$usersdianzantupian,
					'guanzhu'=>$guanzhu,'usersfabu'=>$usersfabu,
					'usersfabutupian'=>$usersfabutupian,'number'=>$number,
					'inter'=>$inter,'data'=>$data,'datt'=>$datt]);
		}
	// 前台用户个人中心 结束

	// 关于订单用户确定付款开始
		public function getQuedingfukuan(Request $request)
		{
			// 获取数据 ，订单的ID
				$uid=session('qid');
				$id = $request->input('id');
			// 改变订单状态 为1 已付款
				$res=DB::table('order')
					->where('id',$id)
					->update(['status'=>'1']);
				$ress=DB::table('order')
					->where('id',$id)
					->first();
			// 改变商品的b_id
				$resss=DB::table('goods')
					->where('id',$ress->goodsid)
					->update(['b_id'=>$uid]);
			//  删除其他关于此商品的订单
				DB::table('order')->where('goodsid',$ress->goodsid)->where('status','=','0')->delete();
				$goods=DB::table('goods')
					->where('id',$ress->goodsid)
					->first();	
				$user=DB::table('user')->where('id',$goods->b_id)->first();
					
			// 给用户发送消息提醒用户尽快发货
					
				$sid=$goods->s_id;
				
				$data['s_id']=$sid;
				$data['f_name']='系统通知';
				$data['s_name']=DB::table('user')->where('id',$data['s_id'])->first()->username;
				$data['regdate']=time();
				$data['content']='您出售的商品：'.$goods->goodsname.',用户'.$user->username.'已付款请尽快发货';

				$num=DB::table('tongzhi')->insert($data);

				if ($res && $resss && $num) 
				{
					return back()->with('success','付款成功');
				}else
				{
					return back()->with('error','付款失败');
				}
		}
	// 关于订单用户确定付款结束

	// 关于订单用户确定发货开始
		public function getQuedingfahuo(Request $request)
		{
			// 获取数据 ，订单的ID
				$uid=session('qid');
				$id = $request->input('id');
			// 改变订单状态 为2 已发货
				$res=DB::table('order')
					->where('id',$id)
					->update(['status'=>'2']);
				$ress=DB::table('order')
					->where('id',$id)
					->first();
			// 查询商品的信息
				
				$goods=DB::table('goods')
					->where('id',$ress->goodsid)
					->first();	
				$user=DB::table('user')->where('id',$goods->b_id)->first();
				$fid=$goods->b_id;
			
				$data['s_id']=$fid;
				$data['f_name']='系统通知';
				$data['s_name']=DB::table('user')->where('id',$data['s_id'])->first()->username;
				$data['regdate']=time();
				$data['content']='您购买的.'.$goods->goodsname.'已发货 请您注意尽快查收 么么哒';

				$num=DB::table('tongzhi')->insert($data);
			if ($ress) 
			{
				return back()->with('success','发货成功！');
			}else
			{
				return back()->with('error','发货失败！');
			}
		}
	// 关于订单用户确定发货结束

	// 关于订单用户确定收货开始
		public function getQuedingshouhuo(Request $request)
		{
			// 获取数据 ，订单的ID
				$uid=session('qid');
				$id = $request->input('id');
			// 改变订单状态 为3 已确定收货
				$res=DB::table('order')
					->where('id',$id)
					->update(['status'=>'3']);
				$ress=DB::table('order')
					->where('id',$id)
					->first();
			// 查询商品的信息
				
				$goods=DB::table('goods')
					->where('id',$ress->goodsid)
					->first();	
				$user=DB::table('user')->where('id',$goods->b_id)->first();
					
					$sid=$goods->s_id;
					$user=DB::table('user')->where('id',$goods->b_id)->first();
					$data['s_id']=$sid;
					$data['f_name']='系统通知';
					$data['s_name']=DB::table('user')->where('id',$data['s_id'])->first()->username;
					$data['regdate']=time();
					$data['content']='您出售的商品：'.$goods->goodsname.',用户'.$user->username.'已确定收货！';

					$num=DB::table('tongzhi')->insert($data);
			if ($ress)
			{
				return back()->with('success','收货成功');
			}else
			{
				return back()->with('error','收货失败');
			}
		}
	// 关于订单用户确定收货结束	

	// 个人中心我的发布商品操作 开始
		public function getUpdgoods(Request $request)
		{
			// 获取商品id
				$id=$request->input('id');
				$res=DB::table('goods')->where('id',$id)->first();
				$restu=DB::table('picture')->where('goods_id',$id)->get();
				return view('Home.User.editgoods',['id'=>$id,'res'=>$res,'restu'=>$restu]);
		}
	// 个人中心我的发布商品操作 结束

	// 个人中心我的发布商品操作修改到数据库 开始
		public function postEditgoods(Request $request)
		{
				$id=$request->only('id');
				$data = $request->except('_token','pic','id');
				$res=DB::table('goods')->where('id',$id)->update($data);
				if($res)
				{
					return redirect('/Home/User/userdetail')->with('success','修改成功'); 
				}else
				{
					return back()->with('error','未作修改');
				}

		}
	// 个人中心我的发布商品操作修改到数据库 结束
	
	// 个人中心我的发布商品操作商品删除 开始
		public function getDelgoods(Request $request)
		{
			// 获取商品id
				$id=$request->input('id');
			// 删除商品表中的商品信息
				$res=DB::table('goods')
					->where('id',$id)
					->delete();
			// 先查询商品所对应的图片 并且在goods文件夹中删除
				// 先获取
				$delpic=DB::table('picture')
					->where('goods_id',$id)
					->get();
				// 遍历数组
				foreach ($delpic as $k => $v) {
					unlink('goods/'.$v->pic);
				}

			// 删除商品所对应的picture表中的图片信息
				$ress=DB::table('picture')
					->where('goods_id',$id)
					->delete();
				// dd($ress,$res);


				if ($res) {

					return redirect('/Home/User/userdetail')->with('success','删除成功');
				}else{
		    		return back()->with('error','删除失败');
		    	}

		}
	// 个人中心我的发布商品操作商品删除 结束 

	// 个人中心我的发布商品图片操作 开始
		public function getUpdgoodspic(Request $request)
		{
			// 获取商品id
			$id=$request->input('id');
			$res=DB::table('picture')->where('goods_id',$id)->get();
			// dd($res);
			return view('Home.User.editgoodspic',['res'=>$res]);
		}
	// 个人中心我的发布商品图片操作 结束

	// 个人中心我的发布商品图片删除 开始
		public function getDelgoodspic(Request $request)
		{
			$id=$request->only('id');
			// 先在数据库中查询
				$restu=DB::table('picture')
					->where('id',$id)
					->first();
					// dd($restu);
				unlink('goods/'.$restu->pic);

			$res=DB::table('picture')
				->where('id',$id)
				->delete();

			if ($res) {
				return back()->with('success','删除成功');
			}
		}
	// 个人中心我的发布商品图片删除 结束
		
	// 个人中心我的发布商品图片修改 开始
		public function getUpdgoodspicpic(Request $request)
		{
			$id=$request->only('id');
			// 查询原图
				$ytu=DB::table('picture')
					->where('id',$id)
					->first();
			return view('Home.User.editgoodspicpic',['ytu'=>$ytu]);

		}
	// 个人中心我的发布商品图片修改 结束

	// 个人中心我的发布商品edit修改 开始  
		public function postEditgoodspicpic(Request $request)
		{
			// 获取商品id
			$id = $request->input('id');
			$pic = $request->except('id','_token');
		    $pic = self::uploads($request);
		    // dd($id);
			$res=DB::table('picture')
				->where('id',$id)
				->update(['pic'=>$pic]);
			if ($res){
				return back()->with('success','修改成功');
			}else{
	    		return back()->with('error','修改失败');
	    	}

		}
	// 个人中心我的发布商品edit修改 结束

	// 修改发布商品的图片方法开始
		static public function uploads($request)
		{
		// 检测是否有文件上传
			if($request->hasfile('pic')){
				$name = md5(time()+rand(1,999999));
				// 获取文件的后缀名
					$suffix = $request->file('pic')->getClientOriginalExtension();
					$arr = ['png','jpeg','jpg','gif'];
					if(!in_array($suffix,$arr)){
					return back()->with('error','上传文件格式不正确');
					}

				$request->file('pic')->move('./goods/',$name.'.'.$suffix);
				return $name.'.'.$suffix;
			}
		}
	// 修改发布商品的图片方法结束	

	// 个人中心发布商品已被买走查看信息 开始
		public function getShowgoods(Request $request)
		{
			$id=$request->input('id');
			// 根据商品id查看商品信息 图片等等
				$goodsxinxi=DB::table('goods')
							->rightJoin('user','goods.b_id','=','user.id')
							->select('goods.*','user.username')
							->where('goods.id',$id)
							->first();
				
				$goodscate =DB::table('cate')
						->where('id',$goodsxinxi->p_id)
						->first();
			
				$goodspic=DB::table('picture')
						->where('goods_id',$id)
						->get();
			
			return view('Home.User.showgoods',['goodsxinxi'=>$goodsxinxi,'goodscate'=>$goodscate,'goodspic'=>$goodspic]);
		}
	// 个人中心发布商品已被买走查看信息 结束

	// 前台用户收货地址列表页 开始
		public function getShouhuodizhilist(Request $request)
		{
			$data=DB::table('shou_address')->where('uid',session('qid'))->get();
			return view('Home.User.shouhuodizhilist',['data'=>$data]);
		}	
	// 前台用户收货地址列表页 结束

	// 前台用户收货地址添加页 开始
		public function getShouhuodizhiadd(Request $request)
		{
			return view('Home.User.shouhuodizhiadd');
		}
	// 前台用户收货地址添加页 结束

	// 前台用户收货地址添加操作 开始
		public function postShouhuodizhiinsert(Request $request)
		{
			$data=$request->except('_token');
			$new_data['shou_address']=$data['s_province'].','.$data['s_city'].','.$data['s_county'];
			$new_data['regdate']=time();
			$new_data['uid']=session('qid');
			
			if(!session('qid')){redirect('/');}
			$res=DB::table('shou_address')->insert($new_data);
			if($res)
			{
				return redirect('/Home/User/shouhuodizhilist')->with('success','操作成功');
			}else
			{
				return back()->with('error','操作失败');
			}
		}
	// 前台用户收货地址添加操作 结束
	

	// 我的拍卖模块 开始
		public function getMypaimai()
		{
			// 查询我发布的拍卖
				$fabu=DB::table('sale')->where('uid',session('qid'))->get();
			// 查询我拍到的拍卖 
				$pai=DB::table('sale')
					->join('user','sale.uid','=','user.id')
					->select('sale.*','user.username')
					->where('b_id',session('qid'))
					->get();
			// 带数据返回视图
				return view('Home.Sale.mypaimai',['fabu'=>$fabu,'pai'=>$pai]);	
			
		}
	// 我的拍卖模块 结束

	// 我的拍卖修改页面 开始
        public function getPaimaiedit(Request $request)
        {
        // 获取数据，拍卖商品的ID
           $id = $request->input('id');

           $cates = DB::table('cate')->where('pid','!=','0')->get(); 

           $sales = DB::table('sale')->where('id',$id)->first();
              
        //解析模板 分配数据
           return view('Home.User.paimaiedit',['sales'=>$sales],['cates'=>$cates]);
        }
    // 我的拍卖修改页面 结束

    // 个人中心执行拍卖修改 开始
        public function postPaimaiupdate(Request $request)
   		{
	        // 提取数据
	          $data = $request->except(['_token']);
	        // 执行数据库修改操作
	          $res = DB::table('sale')->where('id',$data['id'])->update($data);
	        if($res)
	        {
	            return redirect('Home/User/mypaimai')->with('success','操作成功');
	        }else{
	            return back()->with('error','操作失败');
	        }
    	}
  	// 个人中心执行拍卖修改 结束

  	// 个人中心拍卖删除操作 开始
     	public function getPaimaidelete(Request $request)
     	{
	        //接收数据,要删除的拍卖品ID
	          $id = $request->input('id');

	        // 删除拍卖表数据
	          $res = DB::table('sale')->where('id','=',$id)->delete();
	        // 删除拍卖的图片表数据
	          $pic=DB::table('picture')->where('sale_id',$id)->get();
	          foreach ($pic as $key => $v) 
	          {
	              unlink('./sale/'.$v->pic);
	          }
	          $num=DB::table('picture')->where('sale_id',$id)->delete();
	        if($res && $num)
	        {
	          return redirect('Home/User/mypaimai')->with('success','操作成功');
	        }else
	        {
	          return redirect('Home/User/mypaimai')->with('error','操作失败');
	        }
    	}      
 	// 个人中心拍卖删除操作 结束

  	// 个人中心拍卖图片查看 开始
	    public function getPaimaipic(Request $request)
	    {
	      //获取要查看的图片ID 
	        $id = $request->input('id');
	      //数据库查询结果 
	        $res = DB::table('picture')->where('sale_id', $id)->get();
	      //带数据返回视图
	        return view('Home.User.paimaipic', ['res' => $res]);

	    }
  	// 个人中心拍卖图片查看 结束

  	// 个人中心拍卖图片删除 开始
      	public function getPaimaipicdel(Request $request)
      	{
	        // 获取要删除的图片ID
	          $id = $request->input('id');
	        // 获取要删除的图片的文件名
	          $pic=DB::table('picture')->where('id',$id)->first()->pic;
	        // 执行数据库操作
	          $res = DB::table('picture')->where('id', $id)->delete();
	          if($res)
	          {
	            unlink('./sale/'.$pic);
	            return redirect()->back()->with('success','操作成功');
	          }else
	          {
	            return redirect()->back()->with('error','操作失败');
	          }
      	}
  	// 个人中心拍卖图片删除 结束

  	// 个人中心拍卖图片修改页面 开始
	    public function getPaimaipicedit(Request $request)
	    {
	      // 获取数据
	        $id = $request->input('id');
	        $data = DB::table('picture')->where('id', $id)->first();
	      //带数据显示图片修改页
	        return view('Home.User.paimaipicedit', ['data'=>$data]);
	        
	    }
  	// 个人中心拍卖图片修改页面 结束

  	// 个人中心拍卖图片修改执行 开始
	    public function postPaimaipicupdate(Request $request)
	    {
	      //获取id
	        $id = $request->input('id');
	      //获取修改的字段内容
	        $data = $request->except('_token');

	      $oldpic=$data['old_pic'];
	      if (!empty($data['pic']))
	      {
	          $data['pic'] = self::uploadd($request, 'pic');
	          unlink('./sale/'.$oldpic);
	      }else
	      {
	          $data['pic']=$oldpic;
	      }
	      unset($data['old_pic']);
	      //修改的内容
	      $res = DB::table('picture')->where('id', $id)->update($data);
	    
	      //判断修改是否成功
	      if($res)
	      {
	          return redirect('Home/User/mypaimai')->with('success', '修改成功');
	      }else {
	          return redirect()->back()->with('error', '修改失败');
	      }
	    } 
 	// 个人中心拍卖图片修改执行 结束

	// 个人中心查看拍卖订单 开始
	    public function getSeepaimaidingdan(Request $request)
	    {
	    	//拍卖商品的ID 
	    		$id=$request->input('id');
	    		$data=DB::table('sale')
	    			->join('order','order.sale_id','=','sale.id')
	    			->join('user','user.id','=','sale.b_id')
	    			->where('sale.id',$id)
	    			->select('sale.*','order.*','user.*','order.id as orderid','sale.id as saleid')
	    			->first();
	    	// 返回视图：
	    		return view('Home.Sale.paimaidingdan',['data'=>$data]);
	    }
	// 个人中心查看拍卖订单 开始

	// 个人中心用户拍卖确认发货 开始
	    public function getQuerenfahuo(Request $request)
	    {
	    	// 获取确认发货拍卖品的ID
	    		$id=$request->input('id');
	    	// 修改状态
	    		$res=DB::table('sale')->where('id',$id)->update(['status'=>'2']);
	    		if($res)
	    		{
	    			return redirect('/')->with('success','已经确认发货');
	    		}else
	    		{
	    			return redirect('/')->with('error','确认发货失败');
	    		}

	    }
	// 个人中心用户拍卖确认发货 结束

	// 个人中心用户拍卖确认收货 开始
		public function getQuerenshouhuo(Request $request)
	    {
	    	// 获取确认发货拍卖品的ID
	    		$id=$request->input('id');
	    	// 修改状态
	    		$res=DB::table('sale')->where('id',$id)->update(['status'=>'3']);
	    		if($res)
	    		{
	    			return redirect('/')->with('success','已经确认收货');
	    		}else
	    		{
	    			return redirect('/')->with('error','确认收货失败');
	    		}

	    }    
	// 个人中心用户拍卖确认收货 结束    

  	// 文件上传函数 开始
	    static public function uploadd($request, $picname)
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
	            $request->file($picname)->move('./sale/',$name.'.'.$suffix);
	            //返回路径
	            return $name.'.'.$suffix;
	        }
	    }
  	// 文件上传函数 结束

	// 个人中心查看被拍卖的信息 开始
	    public function getPai(Request $request)
	    {
	    	// 拍卖商品的ID
	    		$id=$request->input('id');
	    	// 拍卖者得ID
	    		$b_id=$request->input('b_id');
	    		$data['username']=DB::table('user')->where('id',$b_id)->first()->username;
	    		$data['id']=DB::table('user')->where('id',$b_id)->first()->id;
	    		$data['pname']=DB::table('sale')->where('id',$id)->first()->title;
	    	// 查询交易的价格
                $data['price']=DB::table('jingjia')
                ->where('uid',$b_id)
                ->where('p_id',$id)
                ->orderby('price','desc')
                ->first()->price;
            return view('Home.Sale.inde',['data'=>$data]);    	
	    }
	// 个人中心查看被拍卖的信息 结束

	// 查看用户的个人中心 开始
	    public function getUser(Request $request)
	    {
	    		if(!session('qid'))
	    		{
	    			return redirect()->back()->with('error','您还未登录');
	    		}

	    	// 获取要查看用户的ID
		    	$id=$request->input('id');
		    	if(session('qid')==$id)
		    	{
		    		return redirect('/Home/User/userdetail');
		    	}
		    // 根据用户id获取关注数
				$guanzhu=DB::table('guanzhu')
					->where('b_id',$id)
					->count();
				$g_id = session('qid');
			// 获取用户是否点赞
				$guanz=DB::table('guanzhu')
						->where('g_id',$g_id)
						->where('b_id',$id)
						->get();
				if (!empty($guanz)) {
					$res = 1;
				}else{
					$res = 0;
				}
		    // 查询用户信息和详情信息
		    	$user=DB::table('user')
		    		->join('userdetails','userdetails.uid','=','user.id')
		    		->join('integrals','integrals.uid','=','user.id')
		    		->where('user.id',$id)
		    		->select('userdetails.*','user.*','integrals.integral')
		    		->first();
		    		
		    //  查询该用户发布的商品信息
		    	$goods=DB::table('goods')->where('s_id',$id)->get();
		    //  查询该用户的拍卖信息
		    	$paimai=DB::table('sale')->where('uid',$id)->get();
		    //  查询拍卖的商品的竞价信息
		    	foreach ($paimai as $k => $v) {
		    		$hprice=DB::table('jingjia')->where('p_id',$v->id)->orderby('price','desc')->first();
		    		if($hprice)
		    		{
		    			$v->hprice=$hprice->price;
		    		}else
		    		{
		    			$v->hprice='';
		    		}	
		    	}
		    //  查询用户加入的鱼塘信息
		    	$fish=DB::table('fishmember')
	    			->join('fishs','fishmember.fish_id','=','fishs.id')
	    			->select('fishmember.*','fishs.t_name','fishs.tz_id')
	    			->where('fishmember.member_id','=',$id)
	    			->get(); 
	    			   
		    	return view('Home.User.user',['user'=>$user,'goods'=>$goods,'paimai'=>$paimai,'fish'=>$fish,'res'=>$res,'guanzhu'=>$guanzhu]);
	    }
	// 查看用户的个人中心 结束

	// 查看用户个人中心的发私信 开始
	    public function postFasixin(Request $request)
	    {
	    	// 完善数组内容，插入数据库
		    	$data['f_id']=session('qid');
		    	$data['s_id']=$request->input('sid');
	            $data['content']=$request->input('con');
	            $data['regdate']=time();
	            $data['f_name']=session('qname');
	            $data['s_name']=$request->input('sname');
	        // 插入数据表tongzhi
            	$res=DB::table('tongzhi')->insertGetId($data);
            // 判断是否插入成功
	            if($res)
	            {
	            	echo 1;
	            }else
	            {
	            	echo 0;
	            }
	    }
	// 查看用户个人中心的发私信 结束

	// 用户关注 开始
		public function postGuanzhushu(Request $request)
		{
			// 获取数据
				$g_id = session('qid');
				$b_id=$request->input('id');
			// 插入数据库
				$ress=DB::table('guanzhu')->insert(['g_id'=>$g_id,'b_id'=>$b_id]);
			// 查询关注数
				$guanzhushu=DB::table('guanzhu')
						->where('b_id',$b_id)
						->count();
				if($ress)
				{
					echo $guanzhushu;
				}else
				{
					echo  '0';
				}
		} 
	// 用户关注 结束

	// 用户取消关注 开始
		public function postQuxiaoguanzhu(Request $request)
		{
			// 获取数据
				$g_id = session('qid');
				$b_id=$request->input('id');
			// 删除数据
				$ress=DB::table('guanzhu')
					->where('g_id',$g_id)
					->where('b_id',$b_id)
					->delete();
			// 查询关注数据
			$guanzhushu=DB::table('guanzhu')
					->where('b_id',$b_id)
					->count();
			
			if($ress)
			{
				return $guanzhushu;
			}else
			{
				return 0;
			}
		} 
	// 用户取消关注 结束    
}