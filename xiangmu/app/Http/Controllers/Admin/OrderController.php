<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class OrderController extends Controller
{
	// 商品订单后台查询开始
    	public function getIndex(Request $request)
    	{
            // 获取分页信息和关键字
                $num = $request->input('num') ? $request->input('num') : 5;
                $keyword = $request->input('keyword') ? $request->input('keyword') : '';
            // 查询商品的订单信息
            if (empty($keyword)) {
                $res=DB::table('order')
                    ->leftjoin('goods','order.goodsid','=','goods.id')
                    ->leftjoin('user','order.xiaoshouid','=','user.id')
                    ->where('order.sale_id','=','0')
                    ->select('order.*','user.username','goods.goodsname','goods.price')
                    ->get();
            }else {
                $res=DB::table('order')
                    ->leftjoin('goods','order.goodsid','=','goods.id')
                    ->leftjoin('user','order.xiaoshouid','=','user.id')
                    ->where('order.sale_id','=','0')
                    ->where('name', 'like', '%' . $keyword . '%')
                    ->select('order.*','user.username','goods.goodsname','goods.price')
                    ->get();
            }
         
           //返回视图
           return view('Admin.Order.index',['res'=>$res]);
    	}
    // 商品订单后台查询结束

    // 后台商品订单删除开始
        public function getDel(Request $request)
        {
            // 获取传过来的订单id
            $id=$request->input('id');
            // 删除已完成的订单 如果没有完成则不能删除
                // 先查询该订单的状态
                $status=DB::table('order')
                        ->where('id',$id)
                        ->select('status')
                        ->first()
                        ->status;
               if ($status == '3') {
                   $res=DB::table('order')
                        ->where('id',$id)
                        ->delete();
                    return redirect('/Admin/Order/index')->with('success', '删除成功');
               }else{
                    return redirect()->back()->with('error', '该订单还没有完成 您不能删除');
               }

        }
    // 后台商品订单删除结束

    // 后台拍卖订单查询开始
        public function getPindex(Request $request)
        {
            // 查询拍卖订单信息
            $res=DB::table('order')
                ->leftjoin('sale','order.sale_id','=','sale.id')
                ->leftjoin('jingjia','jingjia.p_id','=','sale.id')
                ->leftjoin('user','order.xiaoshouid','=','user.id')
                ->where('order.sale_id','!=','0')
                ->select('jingjia.price','order.*','sale.title','sale.status','user.username')
                ->get();
            //返回视图
              return view('Admin.Order.pindex',['res'=>$res]);


        }
    // 后台拍卖订单查询结束

    // 后台拍卖订单删除开始
        public function getPdel(Request $request)
        {   
            // 订单表中的id
            $id=$request->input('id');
            // 查询拍卖表中该商品的状态
            $status=DB::table('order')
                ->leftjoin('sale','order.sale_id','=','sale.id')
                ->where('order.id',$id)
                ->select('sale.status')
                ->first()
                ->status;
            if ($status == '3') {
                $res=DB::table('order')
                    ->where('id',$id)
                    ->delete();
                 return redirect('/Admin/Order/pindex')->with('success', '删除成功');
            }else{
                 return redirect()->back()->with('error', '该订单还没有完成 您不能删除');
            }

        }
    // 后台拍卖订单删除结束
}

