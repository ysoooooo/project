<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class GoodsController extends Controller
{

    /**
     * 后台商品添加页面
     *  $cate 提取分类数据
     *  return 返回添加页面
     */
    public function getAdd()
    {
        $cate = DB::table('cate')->where('pid', '!=', '0')->get();
        return view('/Admin.Goods.add', ['cate' => $cate]);
    }

    /**
     * 后台商品添加操作
     *  $res 获取要插入商品表的数据
     *  return 返回index页面
     */
    public function postInsert(Request $request)
    {	
        $res = $request->except('_token', 'pic');
        //插入商品表，然后得到商品ID
        $num = DB::table('goods')->insertGetId($res);
        //插入商品图片表 多文件
        if ($request->hasFile('pic')) {
            foreach ($request->file('pic') as $file) {
                // 上传文件之后的文件名
                $name = md5(time() + rand(1, 999999));
                // 获取后缀名，判断格式
                $suffix = $file->getClientOriginalExtension();
                $arr = ['png', 'jpeg', 'gif', 'jpg'];
                if (!in_array($suffix, $arr)) {
                    return back()->with('error', '上传文件格式不正确');
                }
                //执行文件上传
                $file->move('./goods/', $name . '.' . $suffix);
                //执行数据库图片添加
                $vv['goods_id'] = $num;
                $vv['pic'] = $name . '.' . $suffix;
                $k = DB::table('picture')->insert($vv);
            }
        }
        //判断是否发布成功
        if ($num && $k) {
            return redirect('Admin/Goods/index')->with('success', '发布成功');
        }

    }

    /**
     * 后台商品列表操作
     *  $res 获取需要遍历商品表的数据
     *  $num 获取分页信息
     *  $key 获取搜索信息,并判断
     *   带参数$res返回视图
     *  return 返回index页面
     */
    public function getIndex(Request $request)
    {
        //每页显示几条
        $num = $request->input('num', 5);
        $key = $request->input('key');
        if (empty($key)) 
        {
            $res = DB::table('goods')
                ->leftjoin('cate', 'goods.p_id', '=', 'cate.id')
                ->leftjoin('fishs', 'goods.t_id', '=', 'fishs.id')
                ->leftjoin('user', 'goods.s_id', '=', 'user.id')
                ->select('goods.*', 'cate.name', 'fishs.t_name', 'user.username')
                ->paginate($num);
        } else
        {
            $res = DB::table('goods')
                ->leftjoin('cate', 'goods.p_id', '=', 'cate.id')
                ->leftjoin('fishs', 'goods.t_id', '=', 'fishs.id')
                ->leftjoin('user', 'goods.s_id', '=', 'user.id')
                ->select('goods.*', 'cate.name', 'fishs.t_name', 'user.username')
                ->where('cate.name', 'like', '%' . $key . '%')
                ->orwhere('fishs.t_name', 'like', '%' . $key . '%')
                ->orwhere('user.username', 'like', '%' . $key . '%')
                ->paginate($num);
        }
        $all = $request->all();
        return view('/Admin.Goods.index', ['res' => $res, 'all' => $all]);
    }

    /**
     * 后台商品列表图片显示操作
     *  $data 获取图片表所需的ID
     *  return 带参数$res返回视图index
     *  return 返回index页面
     */
    public function getPicture(Request $request)
    {

        $data = $request->input('id');
        $res = DB::table('picture')
            ->where('goods_id', $data)
            ->get();
        return view('/Admin.Goods.pic', ['res' => $res]);

    }

    /**
     * ajax后台商品删除操作
     *  $id 提取所需删除数据的ID
     *  $res 返回值
     */
    public function postDelete(Request $request)
    {
        $id = $request->input('id');
        $res = DB::table('goods')->where('id', $id)->delete();
        $respic = DB::table('picture')->where('goods_id', $id)->delete();
        if ($res && $respic) 
        {
            echo 1;
        }else
        {
            echo 0;
        }
    }

    /**
     * 后台商品修改操作
     *  $id 提取所需修改数据的ID
     *  $res 返回值
     */
    public function getEdit(Request $request)
    {
        $id = $request->input('id');
        $cate = DB::table('cate')->where('pid','!=','0')->get();
        $res = DB::table('goods')->where('id', $id)->first();
        $respic = DB::table('picture')->where('goods_id', $id)->get();
        //带数据显示修改页
        if ($respic) {
            return view('/Admin.Goods.edit', ['res' => $res, 'cate' => $cate]);
        }
    }

    /**
     *  后台商品修改操作
     *  $id 提取所需修改数据的ID
     *  $res $respic 返回值
     *  图片删除修改不在这
     */
    public function postUpdate(Request $request)
    {

        //获取id
        $id = $request->input('id');
        //获取修改的字段内容
        $data = $request->except('_token', 'pic');
        //修改的内容
        $res = DB::table('goods')->where('id', $id)->update($data);
        //判断修改是否成功
        if ($res) {
            return redirect('/Admin/Goods/index')->with('success', '修改成功');
        } else {
            return redirect()->back()->with('error', '修改失败');
        }
    }

    /**
     * 后台商品图片删除操作
     *  $id 提取所需删除数据的ID
     *  $res 返回值
     */
    public function getPicdel(Request $request)
    {
        $id = $request->input('id');
        $data=DB::table('picture')->where('id',$id)->first();
        $res = DB::table('picture')->where('id', $id)->delete();
        if ($res)
        {
            unlink('./goods/'.$data->pic);
            return redirect('/Admin/Goods/index')->with('success', '删除成功');
        } else 
        {
            return redirect()->back()->with('error', '删除失败');
        }
    }

    /**
     * 后台商品图片修改操作
     *  $id 提取所需修改数据的ID
     *  $res 返回值
     */
    public function getPicedit(Request $request)
    {
        $id = $request->input('id');
        $res = DB::table('picture')->where('id', $id)->first();
        //带数据显示图片修改页
        if ($res) {
            return view('Admin.Goods.picedit', ['res' => $res]);
        }
    }

    /**
     * 后台商品图片修改操作
     *  $id 提取所需修改数据的ID
     *  $res  返回值
     *
     */
    public function postPicupdate(Request $request)
    {

        //获取id
            $id = $request->input('id');
        //获取修改的字段内容
            $oldpic=$request->input('old_pic');
            $data = $request->only('pic');
            if (empty($data['pic']))
            {
                 $data['pic']=$oldpic;
            }else
            {
                unlink('./goods/'.$oldpic);
           
                $data['pic'] = self::upload($request,'pic');
            }
        //修改的内容
            $res = DB::table('picture')->where('id', $id)->update($data);

        //判断修改是否成功
            if($res) 
            {
                return redirect('/Admin/Goods/index')->with('success', '修改成功');
            } else
            {
                return redirect()->back()->with('error', '未做修改！');
            }
    }

    /**
     * 后台商品图片上传操作
     *
     *  return 返回值
     */
    static public function upload($request, $pic)
    {
        //判断是否有文件上传
        if ($request->hasFile($pic)) {
            //随机文件名
            $name = md5(time() + rand(1, 999999));
            //获取文件的后缀名
            $suffix = $request->file($pic)->getClientOriginalExtension();
            $arr = ['png', 'jpeg', 'gif', 'jpg'];
            if (!in_array($suffix, $arr)) {
                return back()->with('error', '上传文件格式不正确');
            }
            $request->file($pic)->move('./goods/', $name . '.' . $suffix);
            //返回路径
            return $name . '.' . $suffix;
        }
    }
}