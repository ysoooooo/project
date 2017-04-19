<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class ParentController extends Controller
{

    /**
     * 后台主页面
     *  App\Http\Controllers\Admin
     *  return 带参数返回主页面
     */
    public function getParent()
    {    
        //鱼塘操作   
        $fishs = DB::table('fishs')->orderBy('createtime', 'desc')->paginate(3);
        $numfish = DB::table('fishs')->count();

        //拍卖操作
        $sales = DB::table('sale')->orderBy('id', 'desc')->paginate(3);
        $numsale = DB::table('sale')->count();

        //商品
        $goods = DB::table('goods')->orderBy('created_at', 'desc')->paginate(3);
        $numgood = DB::table('goods')->count();

        //用户操作
        $users = DB::table('user')->orderBy('created_at', 'desc')->paginate(3);
        $numuser = DB::table('user')->count();
        return view('/Admin.User.parents',
                    ['fishs' => $fishs, 
                    'numfish' => $numfish,
                    'sales' => $sales, 
                    'numsale' => $numsale,

                    'goods' => $goods, 
                    'numgood' => $numgood,

                    'users' => $users, 
                    'numuser' => $numuser,

                    ]);
    }

    //跳转鱼塘列表页
    public function getFishs()
    {
        return redirect('/Admin/Yutang/index');
    }

    //跳转用户列表页
    public function getUsers()
    {
        return redirect('/Admin/User/index');
    }

    //跳转拍卖列表页
    public function getSales()
    {
        return redirect('/Admin/Sale/index');
    } 

    //跳转商品列表页
    public function getGoods()
    {
        return redirect('/Admin/Goods/index');
    }



    
}