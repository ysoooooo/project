<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\AuctionPostRequest;
// 导入 Intervention Image Manager Class
use Intervention\Image\ImageManager;

class AuctionController extends Controller
{
    // 用户发布拍卖 开始
        public function getAuction(Request $request)
        {
            // 获取分类表的所有数据
            $cate = DB::table('cate')->where('pid', '!=', '0')->get();

            return view('Home.Goods.auction', ['cate' => $cate]);
        }
    // 用户发布拍卖 结束

    // 添加拍卖操作 开始
        public function postInsert(Request $request)
        {
              $res = $request->except(['_token','pic']);
              $res['uid']=session('qid');
              $num = DB::table('sale')->insertGetId($res);
            //插入拍卖图片表 多文件
                if($request->hasFile('pic'))
                {
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
                            $image = $manager->make('uploads/'.$name.'.'.$suffix)->resize(350,419);

                        // 将处理后的图片重新保存到其他路径
                            $image->save('sale/'.$name.'.'.$suffix);
                    //执行数据库图片添加 
                        $vv['sale_id']=$num;$vv['pic']=$name.'.'.$suffix;
                        $k=DB::table('picture')->insert($vv);
                    }
                }
                if($res && $k)
                {
                    return redirect('/')->with('success','发布成功');
                }else
                {
                    return back()->with('error','发布失败');
                }
        }
    // 添加拍卖操作 结束

    // 同一类型的拍卖展示 开始
        public function getCate(Request $request)
        {
            // 获取id  name
                $id=$request->id;
                $names=$request->name;
            // 获取父级类型
                $r=DB::table('cate')->where('id',$id)->first();
                $pname=DB::table('cate')->where('id',$r->pid)->first()->name;
            // 联查属于此类型的所有拍卖品的信息数据
                $sales = DB::table('cate')
                ->rightJoin('sale', 'cate.id', '=', 'sale.p_id')
                ->where('sale.p_id','=',"$id")
                ->get();
                $a=[];    
            // 遍历商品  链接图片表 获取商品图片的信息
                foreach ($sales as $k => $v) 
                {
                // 读取图片
                   $arrtupian=DB::table('picture')->where('sale_id',$v->id)->first();
                // 将图片表在重新组建成一个数组
                   array_push($a,$arrtupian);

                }
            // 传递给视图
            return view('Home.Sale.pm',['names'=>$names,'a'=>$a,'sales'=>$sales,'pname'=>$pname]);
        }
    // 同一类型的拍卖展示 结束
    
    // 拍卖详情 开始
        public function getXq(Request $request)
        {
            // 接收数据，拍卖品的ID
                $id=$request->input('id');
            // 获取拍卖商品的信息
                $data=DB::table('sale')->where('id',$id)->first();
                $time=strtotime($data->ltime);
                if($time<=time())
                {
                    return back();
                }
            // 获取发布者姓名
                $uid=$data->uid;
                if($uid=='0')
                {
                    $name='网站发布';
                }else
                {
                    $user=DB::table('user')->where('id',$uid)->first();
                }
            // 获取商品的图片
                $pic=DB::table('picture')->where('sale_id',$id)->get();
            // 查询有没有人竞价
                $res=DB::table('jingjia')->orderby('price','desc')->where('p_id',$id)->first();
                if($res==null)
                {
                    // 返回详情页
                    return view('Home.Sale.xq',['data'=>$data,'pic'=>$pic,'user'=>$user]);
                    
                }else
                {
                    return view('Home.Sale.xq',['data'=>$data,'pic'=>$pic,'user'=>$user,'res'=>$res]);
                }
            
        }
    // 拍卖详情 结束

    // 用户出价 开始
        public function postJingjia(Request $request)
        {
            // 获取数据
                $data['p_id']=$request->input('pid');
                $data['price']=$request->input('price');
                $data['uid']=session('qid');
            // 插入数据库
                $res=DB::table('jingjia')->insert($data);
                if($res)
                {
                   echo $data['price'];
                }else
                {
                    echo 0;
                }

        } 
    // 用户出价 结束 

    // 价高者得 开始
        public function postChengjiao(Request $request)
        {
            // 获取数据,成交的拍卖商品ID
                $id=$request->input('pid');
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
                            echo 1;
                        }else
                        {
                            echo 0;
                        }
                        return;
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
                if($data)
                {
                    echo 1;
                }else
                {
                    echo 0;
                }

        }
    // 价高者得 结束

    // 拍卖收货信息 开始
        public function getXuanzedizhiye(Request $request)
        {
            // 获取数据 商品的ID和购买者的ID
                $sale_id=$request->input('id');
                $uid=session('qid');
            // 查询收货地址
                $data=DB::table('shou_address')->where('uid',$uid)->get();
                if($data){
                    return view('Home.Sale.xuanzedizhiye',['data'=>$data,'sale_id'=>$sale_id]);
                }else{
                    return redirect()->back()->with('error','您还没有添加收货地址，请前去个人中心填写');
                }
            
        }
    // 拍卖收货信息 结束

    // 确定信息页 开始
        public function getQuedingjiaoyiye(Request $request)
        {
            // 获取数据，商品的ID
                $sale_id=$request->input('sale_id');
                $data=DB::table('sale')->where('id',$sale_id)->first();
            // 查询交易的价格
                $price=DB::table('jingjia')
                ->where('uid',session('qid'))
                ->where('p_id',$sale_id)
                ->orderby('price','desc')
                ->first()->price;
                $data->shou_address=$request->input('shou_address');
                $data->shouname=$request->input('shouname');
                $data->shoutelphone=$request->input('shoutelphone');
                
            // 查询商品信息，传输数据到视图
                
                return view('Home.Sale.quedingjiaoyiye',['data'=>$data,'price'=>$price]);
        }
    // 确定信息页 结束 

    // 确定信息后 开始
        public function getDoqueding(Request $request)
        {

                $data['sale_id']=$request->input('sale_id');
                $data['address']=$request->input('shou_address');
                $data['shouname']=$request->input('shouname');
                $data['telphone']=$request->input('shoutelphone');
                $data['numbers']=rand(10000,99999);
                $data['ordertime']=time();
                $data['goumaiid']=session('qid');
                    // 获取商品信息
                    $sale=DB::table('sale')->where('id',$data['sale_id'])->first();
                $data['xiaoshouid']=$sale->uid;   
            // 插入order表
                $res=DB::table('order')->insert($data);
            // 修改拍卖品的状态为1
                DB::table('sale')->where('id',$data['sale_id'])->update(['status'=>'1']);

            // 插入通知表的信息
                $dat=[];
                $dat['s_id']=$sale->uid;
                $dat['f_name']='系统通知';
                $dat['s_name']= DB::table('user')->where('id',$sale->uid)->first()->username;
                $dat['regdate']=time();
                $dat['content']='您发布的拍卖'.$sale->title.','.session('qname').'已填写了收货信息,请尽快发货！';
           
            //执行插入通知表
                $num=DB::table('tongzhi')->insert($dat);
                if($res && $num)
                {
                    return redirect('/')->with('success','操作成功！等待发货。。。');
                }else
                {
                    return redirect('/')->with('error','操作失败');
                }   
        }
    // 确定信息后 结束 

    // 用户参与塘主征集 开始
        public function postCanyu(Request $request)
        {
            $data['t_id']=$request->input('tid');
            $data['t_name']=$request->input('tname');
            $data['uid']=session('qid');

            $res=DB::table('huodong')->insert($data);
            if($res)
            {
                echo 1;
            }else
            {
                echo 0;
            }    
        }
    // 用户参与塘主征集 结束

    // 活动结束 开始
        public function postJieshu(Request $request)
        {
            //获取鱼塘的ID
                $t_id=$request->input('tid');
                $t_name=$request->input('tname');
            // 随机取出一个参与者作为塘主
                $data=DB::table('huodong')->where('t_id',$t_id)->where('uid','!=','0')->get();
                if(empty($data))
                {
                     $re= DB::table('huodong')->where('t_id',$t_id)->delete();
                     return;
                }
                foreach($data as $v)
                {
                    $res[]=$v->uid;
                }
                $k=array_rand($res);
                $uid=$res[$k];
            // 修改此鱼塘的信息

                // 判断此人是否加入鱼塘成员表。如果未加入，执行加入
                $join=DB::table('fishmember')->where('member_id',$uid)->where('fish_id',$t_id)->first();
                if(!$join)
                {
                    $join=DB::table('fishmember')->insert(['member_id'=>$uid,'fish_id'=>$t_id]);
                }
            // 改变鱼塘塘主的状态
               $res=DB::table('fishs')->where('id',$t_id)->update(['tz_id'=>$uid]);
               if($res)
               {
                    // 修改用户的权限为2
                        $r=DB::table('user')->where('id',$uid)->update(['auth'=>'2']);
                    // 清空活动表数据
                        $re= DB::table('huodong')->where('t_id',$t_id)->delete();
                    // 消息通知
                        $dat['s_id']=$uid;
                        $dat['f_name']='系统通知';
                        $dat['s_name']= DB::table('user')->where('id',$uid)->first()->username;
                        $dat['regdate']=time();
                        $dat['content']='恭喜你，在塘主征集令中,您被选中为【'.$t_name.'】塘的塘主。注销登录管理鱼塘吧';
                        $ress=DB::table('tongzhi')->insert($dat);
                        if($re && $ress && $r)
                        {
                            echo 1;
                        }else
                        {
                            echo 0;
                        }    
               } 
        }
    // 活动结束 结束
}

?>