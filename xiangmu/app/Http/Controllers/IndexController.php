<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{
	public function index()
	{
		//返回视图并判断状态
		$res = DB::table('configure')->first()->status;
		if($res=='1'){
       		return view('Home.index');
   		}else{
   			return view('errors.weihu');
   		}

	}

	// 头部鱼塘分类的数据遍历 开始
		static public function headfish()
		{
			// 遍历商品分类，前台展示 开始
				$arr=DB::table('cate')->where('pid',0)->get();
				foreach ($arr as $key => $v) {
					$res[$v->name]=[];
					$ar=DB::table('cate')->where('pid',$v->id)->get();
					array_push($res[$v->name],$ar);
				}
			//结果返回视图 
				return view('Home.Index.headfish',['res'=>$res]);
		}
	// 头部鱼塘分类的数据遍历 结束

	//轮播图静态方法开始
		static public function lunbo()
		{
			// 在数据库中获取要轮播的图片
			$lunbo = DB::table('lunbotu')
					->join('cate','lunbotu.cate_id','=','cate.id')
					->select('lunbotu.*','cate.name')
					->get();
			//获取第一条数据
			$lunbofirst=$lunbo[0];
			
			//将第一条数据抛出，组成数组
			$lunbotu=array_shift($lunbo);

			//返回视图
			return view('Home.Index.lunbo',['lunbo'=>$lunbo,'lunbofirst'=>$lunbofirst]);
		}
	//轮播图静态方法结束
	
	// 头部精品发布分类的数据遍历 开始	
		static public function headshow()
		{
			// 遍历商品分类，前台展示 开始
				$arr=DB::table('cate')->where('pid',0)->get();
				foreach ($arr as $key => $v) {
					$res[$v->name]=[];
					$ar=DB::table('cate')->where('pid',$v->id)->get();
					array_push($res[$v->name],$ar);
				}
			//结果返回视图 
				return view('Home.Index.headshow',['res'=>$res]);
		}
	// 头部精品发布分类的数据遍历 结束
	
	// 头部拍卖分类的数据遍历 开始		
		static public function headpaimai()
		{
			// 遍历商品分类，前台展示 开始
				$arr=DB::table('cate')->where('pid',0)->get();
				foreach ($arr as $key => $v) {
					$res[$v->name]=[];
					$ar=DB::table('cate')->where('pid',$v->id)->get();
					array_push($res[$v->name],$ar);
			}
			//结果返回视图 
				return view('Home.Index.headpaimai',['res'=>$res]);
		}
	// 头部拍卖分类的数据遍历 结束
	
	// 页面中最近发布板块的数据 开始
		static public function zuijinfabu()
		{
			// 遍历商品分类，前台展示 开始
				$arr=DB::table('goods')->orderby('created_at','desc')->take(6)->where('b_id','0')->get();
				if(!$arr){return;}
				$a=[];
				foreach ($arr as $key => $v)
				{
					$pic=DB::table('picture')->where('goods_id',$v->id)->first();
					array_push($a,$pic);
				}
				if(!$a){return;}
			//结果返回视图
				return view('Home.Index.zuijinfabu',['arr'=>$arr,'a'=>$a]);
		}
	// 页面中最近发布板块的数据	 结束

	// 页面中精品鱼塘板块的数据 开始
		static public function jingpinyutang()
		{
			// 遍历商品分类，前台展示 开始
				$arr=DB::table('fishs')->take(3)->get();
				if(!$arr){return;}
			//结果返回视图
				return view('Home.Index.jingpinyutang',['arr'=>$arr]);
		}
	// 页面中精品鱼塘板块的数据	 结束

	// 头部已登录个人中心 开始
		static public function login()
		{
			$qpic=session('qpic');
			return view('Home.Index.login',['qpic'=>$qpic]);
		}
	// 头部已登录个人中心 结束	 

	//友情链接静态方法开始
		static public function footer()
		{
			//查询数据库中信息
			$friend=DB::table('friendlink')->orderby('id')->get();

			//解析
			return view('Home.Index.footer',['friend'=>$friend]);
		}
	//友情链接静态方法结束

	//消息通知 开始
		static public function tongzhi()
		{
			//查询数据库中信息
			$data=DB::table('tongzhi')->where('s_id',session('qid'))->where('dufou','0')->get();
			$num=count($data);	

			//解析
			return view('Home.Index.tongzhi',['num'=>$num]);
		}
	//消息通知 结束	

	//网站配置静态方法开始
		//网站配置中网站版权
		static public function config()
		{
			//查询数据库中信息
			$con=DB::table('configure')->get();
			//解析
			return view('Home.Index.config',['con'=>$con]);
		}
		
		//网站配置中网站名称
		static public function title()
		{
			//查询数据库中信息
			$cont=DB::table('configure')->get();
			//解析
			return view('Home.Index.title',['cont'=>$cont]);
		}
		//网站配置中网站logo
		static public function logo()
		{
			//查询数据库中信息
			$logo=DB::table('configure')->get();
			//解析
			return view('Home.Index.logo',['logo'=>$logo]);
		}
	//网站配置静态方法结束
		
	//广告查询开始
		static public function guanggao()
		{
			//查询数据库信息
			$ads = DB::table('ad')->get();
			//解析
			return view('Home.Index.guanggao',['ads'=>$ads]);
		}
	//广告查询结束	

	// 鱼塘申请活动开始
		static public function huodong()
		{
			//查询数据库信息
				$data=DB::table('huodong')->where('uid','=','0')->first();

				$res=DB::table('huodong')->where('uid',session('qid'))->first();
				if($res)
				{
					return view('Home.Index.huodong',['data'=>$data,'res'=>$res]);
				}else
				{
					//解析
						return view('Home.Index.huodong',['data'=>$data]);
				}
			
		}
	// 鱼塘申请活动结束

	// 拍卖价高者得 开始
		static public function paimai()
		{
			$data=DB::table('sale')->get();
			foreach($data as $v)
			{
				
				if(strtotime($v->ltime)<=time() && $v->status=='0')
				{
	 				// 获取数据,成交的拍卖商品ID
		                $id=$v->id;
		            // 通过商品的ID查询竞价表中的价格最高者得到ID
		                $sale=DB::table('jingjia')->where('p_id',$id)->orderby('price','desc')->first();
		            // 判断此拍卖品是否有人出价
		                if(!$sale)
		                {
		                    // 查询发布者的ID
		                        $fabuid=DB::table('sale')->where('id',$id)->first()->uid;
		                        $fabuname=DB::table('user')->where('id',$fabuid)->first()->username;
		                    // 插入通知表，通知发布拍卖者
		                        $fabu['s_id']=$fabuid;
		                        $fabu['content']='您发布的拍卖已经结束！无人拍买';
		                        $fabu['regdate']=time();
		                        $fabu['f_name']='管理员通知';
		                        $fabu['s_name']=$fabuname;
		                        $data=DB::table('tongzhi')->insert($fabu);
		                        if($data)
		                        {
		                          return;  
		                        }
		                        
		                }    
		                $maiid=$sale->uid;
		            // 通过商品ID查询拍卖的信息
		                $sa=DB::table('sale')->where('id',$id)->first();
		            // 修改拍卖商品的买者ID
		                $res=DB::table('sale')->where('id',$id)->update(['b_id'=>$maiid,'status'=>'4']);
		                if(!$res){return;}
		            // 通过ID查询用户名
		                $mainame=DB::table('user')->where('id',$maiid)->first()->username;
		                $fabuid=DB::table('sale')->where('id',$id)->first()->uid;

		                $fabuname=DB::table('user')->where('id',$fabuid)->first()->username;
		            // 插入通知表，通知卖家和买家
		                
		                $fabu['s_id']=$fabuid;
		                $fabu['content']=$mainame.'拍下了您发布的'.$sa->title;
		                $fabu['regdate']=time();
		                $fabu['f_name']='管理员通知';
		                $fabu['s_name']=$fabuname;
		        
		                $mai['s_id']=$maiid;
		                $mai['content']='您拍下了'.$fabuname.'发布的'.$sa->title.'请去个人中心结算';
		                $mai['regdate']=time();
		                $mai['f_name']='管理员通知';
		                $mai['s_name']=$mainame;
		                
		            // 执行插入
		                $data=DB::table('tongzhi')->insert([$fabu,$mai]);    
				}
			}	
		}
	// 拍卖价高者得 结束

}
?>