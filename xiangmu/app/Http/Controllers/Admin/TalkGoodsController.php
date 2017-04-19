<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;


class TalkGoodsController extends Controller
{
    /**
     * 后台消息列表操作
     *  $res 获取需要遍历商品表的数据
     *  $num 获取分页信息
     *  $key 获取搜索信息,并判断
     *   带参数$res返回视图
     *  return 返回index页面
     */
    public function getIndex(Request $request)
    {
        //每页显示几条
        $num = $request->input('num', 2);
        $key = $request->input('key');
        if (empty($key)) {
            $res = DB::table('talk_goods')
                ->paginate($num);
        } else {
            $res = DB::table('talk_goods')
                ->select('talk_goods.*')
                ->where('talk_goods.uid', 'like', '%' . $key . '%')
                ->orwhere('talk_goods.uname', 'like', '%' . $key . '%')
                ->orwhere('talk_goods.content', 'like', '%' . $key . '%')
                ->orwhere('talk_goods.productname', 'like', '%' . $key . '%')
                ->paginate($num);
        }
        $all = $request->all();
        return view('/Admin.TalkGoods.index', ['res' => $res, 'all' => $all]);
    }

    /**
     * ajax后台消息状态显示操作
     *  $id 提取所需修改数据的ID
     *  $res 返回值
     */
    public function postUpdatesta(Request $request)
    {   
        $id = $request->input('id');
        $data = DB::table('talk_goods')->where('id', $id)->first();
        
        if ($data->status =='1') {
            $status ='0';
        }else{
           $status = '1';
        }
        $res = DB::table('talk_goods')
                    ->where('id',$id)
                    ->update(['status'=>$status]);

        $dat = DB::table('talk_goods')
                    ->where('id',$id)
                    ->first();            

        if ($res)
        {
            if($dat->status)
            {
                echo "1";
            }else
            {
               echo "0";
            }
        }else
        {
        	echo '2';
        }
    }

    /**
     * 后台消息删除操作
     *  $id 提取所需删除数据的ID
     *  $res 返回值
     */
    public function getDelete(Request $request)
    {
        $id = $request->input('id');
        $res = DB::table('talk_goods')->where('id', $id)->delete();
        if ($res) {
            return redirect('/Admin/TalkGoods/index')->with('success', '删除成功');
        } else {
            return redirect()->back()->with('error', '删除失败');
        }
    }

    /**
     *  后台消息修改操作
     *  $id 提取所需修改数据的ID
     *  $res 返回值
     */
    public function getEdit(Request $request)
    {
        $id = $request->input('id');
        $res = DB::table('talk_goods')->where('id', $id)->first();
        //带数据显示修改页
        if ($res) {
            return view('/Admin.TalkGoods.edit', ['res' => $res]);
        }
    }

    /**
     *  后台消息修改操作
     *  $id 提取所需修改数据的ID
     *  $res 返回值
     *  
     */
    public function postUpdate(Request $request)
    {

        //获取id
        $id = $request->input('id');
        //获取修改的字段内容
        $data = $request->only('content');
        // dd($data);
        $content = $data['content'];
        //修改的内容
        $res = DB::table('talk_goods')->where('id', $id)->update(['content'=>$content]);
        //判断修改是否成功
        if ($res) {
            return redirect('/Admin/TalkGoods/index')->with('success', '修改成功');
        } else {
            return redirect()->back()->with('error', '修改失败');
        }
    }
}