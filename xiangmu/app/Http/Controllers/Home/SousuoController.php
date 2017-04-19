<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class SousuoController extends Controller
{
	public function getIndex(Request $request)
	{
      //搜索的关键字
       $zd = $request->input('title');
      //每页显示几条
       $num = $request ->input('num',2);
        //判断用户是否搜素
	      if($request->input('title')) 
        {
         //查询拍卖中是否有该商品 
	        $sales = DB::table('sale')
	          ->select('sale.*')
	          ->where('title','like','%'.$request->input('title').'%')
	          ->paginate($num);

         //查询商品中是否有该商品
          $arr = DB::table('goods')
            ->select('goods.*')
            ->where('goodsname','like','%'.$request->input('title').'%')
            ->paginate($num);
	       
        }else{
          // 联查属于此类型的所有拍卖品的信息数据
            $sales = DB::table('sale')
            	   ->select('sale.*')
            	   ->paginate($num);

          // 联查属于此类型的所有商品的信息数据      
            $arr = DB::table('goods')
                 ->select('goods.*')
                 ->paginate($num);
        }	   
          // 遍历拍卖  链接图片表 获取拍卖图片的信息
            $pt=[];    
            foreach ($sales as $k => $v) 
            {
              // 读取图片
                 $arrtupian=DB::table('picture')->where('sale_id',$v->id)->first();
              // 将图片表在重新组建成一个数组
                 array_push($pt,$arrtupian);

            }
          // 遍历商品  链接图片表 获取商品图片的信息
            $st=[];    
            foreach ($arr as $k => $v)
            {
              // 读取图片
                $arrtupian=DB::table('picture')->where('goods_id',$v->id)->first();
              // 将图片表在重新组建成一个数组
                array_push($st,$arrtupian);
            }

            $all = $request -> all(); 
          // 传递给视图
            return view('Home.Sousuo.index',['pt'=>$pt,'st'=>$st,'sales'=>$sales,'all'=>$all,'arr'=>$arr,'zd'=>$zd]);
  }   
}








