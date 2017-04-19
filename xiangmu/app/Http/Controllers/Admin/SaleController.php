<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
// 导入 Intervention Image Manager Class
use Intervention\Image\ImageManager;

class SaleController extends Controller
{

  // 拍卖列表 开始
    public function getIndex(Request $request)
    {  
      //每页显示几条
        $num = $request ->input('num',5);
      //判断用户是否搜素
        if($request->input('title'))
        {
          $sales = DB::table('sale')
            ->join('user', 'user.id', '=', 'sale.uid')
            ->select('sale.*','user.username')
            ->where('title','like','%'.$request->input('title').'%')
            ->paginate($num);
        }else{
      //查询数据
          $sales = DB::table('sale')
                  ->join('user', 'user.id', '=', 'sale.uid')
                  ->select('sale.*','user.username')
                  ->paginate($num);
        }
      $all = $request -> all();
      return view('Admin.Sale.index',['sales'=>$sales,'all'=>$all]);
    }
  // 拍卖列表 结束

  // 拍卖添加页面 开始
    public function getAdd()
    {
        $cates = DB::table('cate')->where('pid','!=','0')->get(); 
        return view('Admin.Sale.add',['cates'=>$cates]);
    }
  // 拍卖添加页面 结束

  // 添加拍卖操作 开始
    public function postInsert(Request $request)
    {
        $res = $request->except(['_token','pic']);
        $num = DB::table('sale')->insertGetId($res);
      // 插入拍卖图片表 多文件
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
            // 执行文件上传 
                $file->move('./uploads/', $name.'.'.$suffix);
                // 通过指定 driver 来创建一个 image manager 实例
                $manager = new ImageManager(array('driver' => 'gd'));

                // 最后创建 image 实例
                $image = $manager->make('uploads/'.$name.'.'.$suffix)->resize(350,419);

                // 将处理后的图片重新保存到其他路径
                $image->save('sale/'.$name.'.'.$suffix);
            // 执行数据库图片添加 
                $vv['sale_id']=$num;$vv['pic']=$name.'.'.$suffix;
                $k=DB::table('picture')->insert($vv);
            }
          }
          if($res && $k){
              return redirect('Admin/Sale/index')->with('success','添加成功');
         }else{
            return back()->with('error','添加失败');
      }
    }
  // 添加拍卖操作 结束 
  

  // 拍卖修改页面 开始
      public function getEdit(Request $request)
      {
        // 获取数据，拍卖商品的ID
          $id = $request->input('id');

          $cates = DB::table('cate')->where('pid','!=','0')->get(); 

          $sales = DB::table('sale')->where('id',$id)->first();
              
        //解析模板 分配数据
          return view('Admin.Sale.edit',['sales'=>$sales],['cates'=>$cates]);
      }
  // 拍卖修改页面 结束

  // 执行拍卖修改 开始
    public function postUpdate(Request $request)
    {
        // 提取数据
          $data = $request->except(['_token']);
        // 执行数据库修改操作
          $res = DB::table('sale')->where('id',$data['id'])->update($data);
        if($res)
        {
            return redirect('Admin/Sale/index')->with('success','操作成功');
        }else{
            return back()->with('error','操作失败');
        }
    }
  // 执行拍卖修改 结束

  // 删除操作 开始
     public function getDelete(Request $request)
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
          return redirect('Admin/Sale/index')->with('success','操作成功');
        }else
        {
          return redirect('Admin/Sale/index')->with('error','操作失败');
        }
     }      
  // 删除操作 结束

  //图片查看 开始
    public function getPicture(Request $request)
    {
      //获取要查看的图片ID 
        $id = $request->input('id');
      //数据库查询结果 
        $res = DB::table('picture')->where('sale_id', $id)->get();
      //带数据返回视图
        return view('/Admin.Sale.pic', ['res' => $res]);

    }
  //图片查看 结束

  //图片删除 开始
      public function getPicdel(Request $request)
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
  //图片删除 结束

  //图片修改页面 开始
    public function getPicedit(Request $request)
    {
      // 获取数据
        $id = $request->input('id');
        $data = DB::table('picture')->where('id', $id)->first();
      //带数据显示图片修改页
        return view('Admin.Sale.picedit', ['data'=>$data]);
        
    }
  //图片修改页面 结束

  //图片修改执行 开始
    public function postPicupdate(Request $request)
    {
      //获取id
        $id = $request->input('id');
      //获取修改的字段内容
        $data = $request->except('_token');

      $oldpic=$data['old_pic'];
      if (!empty($data['pic']))
      {
          $data['pic'] = self::upload($request, 'pic');
          unlink('./sale/'.$oldpic);
      }else
      {
          $data['pic']=$oldpic;
      }
      unset($data['old_pic']);
      //修改的内容
      $res = DB::table('picture')->where('id', $id)->update($data);
    
      //判断修改是否成功
      if ($res) {
          return redirect('/Admin/Sale/index')->with('success', '修改成功');
      } else {
          return redirect()->back()->with('error', '修改失败');
      }
    } 
  //图片修改执行 结束

  // 文件上传函数 开始
    static public function upload($request, $picname)
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

  // 查看拍卖详情 开始
    public function getPaimaidetail(Request $request)
    {
        // 拍卖商品的ID
          $id=$request->input('id');
        // 拍卖获得者得ID
          $b_id=$request->input('b_id');
          $data['username']=DB::table('user')->where('id',$b_id)->first()->username;
        // 查询拍卖品信息
          $res=DB::table('sale')->where('id',$id)->first();
        // 拍卖的商品名
          $data['pname']=$res->title;
        // 拍卖商品的状态
          $data['status']=$res->status;
        // 查询交易的价格
                $data['price']=DB::table('jingjia')
                ->where('uid',$b_id)
                ->where('p_id',$id)
                ->orderby('price','desc')
                ->first()->price;
            return view('Admin.Sale.paimaidetail',['data'=>$data]); 
    }
  // 查看拍卖详情 结束
}

