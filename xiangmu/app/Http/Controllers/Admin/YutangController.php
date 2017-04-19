<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\UserPostRequest;


class YutangController extends Controller
{
  // 添加鱼塘展示页 开始
    public function getAdd()
    {
      // 后台添加鱼塘 开始
        $data=DB::table('cate')->where('pid','!=','0')->get();
      // 展示鱼塘添加页
        return view('Admin.Yutang.add',['catelist'=>$data]);
    }
  // 添加鱼塘展示页 结束

  // 鱼塘添加操作 开始
    public function postInsert(Request $request)
    {
      $data=null;
      $res = $request->except('_token');
      // var_dump($res);
      $data['t_name']=$res['t_name'];
      $data['t_title']=$res['t_title'];
      $data['cate_id']=$res['cate_id'];
      $data['t_pic']=$res['t_pic'];
      $data['t_bac']=$res['t_bac'];
      $data['createtime']=time();
      if (!empty($res['t_pic']))
      {
          $data['t_pic'] = self::upload($request, 't_pic');
      }

      if (!empty($res['t_bac']))
      {
          $data['t_bac'] = self::upload($request, 't_bac');
      }
        
      // dd($data);
      $res=DB::table('fishs')->insert($data);
      if($res)
      {
        return back()->with('success', '操作成功');
      }else
      {
        return back()->with('error', '操作失败');
      }
    }
  // 鱼塘添加操作 结束

  // 鱼塘列表 开始
    public function getIndex(Request $request)
    {

      $num = $request->input('num') ? $request->input('num') : 5;

      $data = DB::table('fishs')
                ->join('cate','fishs.cate_id','=','cate.id')
                ->select('fishs.*','cate.name')->orderby('fishs.id','desc')
                ->paginate($num);
      return view('Admin.Yutang.index',['data'=>$data,'page' => $request->all()]);
    }
  // 鱼塘列表 结束

  // 鱼塘信息修改页 开始
    public function getEdit(Request $request)
    {
        $id=$request->input('id');
      //通过鱼塘ID查询鱼塘信息
        $data=DB::table('fishs')->where('id',$id)->first();
        $catelist=DB::table('cate')->where('pid','!=','0')->get();

      //查询塘主名称
        $tz_name=DB::table('user')->where('id',$data->tz_id)->first();
        if($tz_name)
        {
            $tz_name=$tz_name->username;         
            return view('Admin.Yutang.edit',['data'=>$data,'catelist'=>$catelist,'tz_name'=>$tz_name]);
        }else
        {
            // 查询活动表，是否在进行塘主征集
                $res=DB::table('huodong')->get();
                if($res)
                {
                    return view('Admin.Yutang.edit',['data'=>$data,'catelist'=>$catelist,'res'=>$res]);
                }    
             return view('Admin.Yutang.edit',['data'=>$data,'catelist'=>$catelist]);
        } 
    }
  // 鱼塘信息修改页 结束

  // 鱼塘信息修改操作 开始
    public function postUpdate(Request $request)
    {
      $data = $request->except('_token','old_t_pic','old_t_bac');
      $oldpic=$request->input('old_t_pic');
      $oldbac=$request->input('old_t_bac');

      if (empty($data['t_pic']))
      {
          $data['t_pic']=$oldpic;
      }else
      {
        if($oldpic != 'default.jpg')
        {
           unlink('./fish/'.$oldpic);
        }
          $data['t_pic'] = self::upload($request, 't_pic');

      }
      if (empty($data['t_bac']))
      {
          $data['t_bac']=$oldbac;
      }else
      {
          if($oldpic != 'default.jpg')
          {
             unlink('./fish/'.$oldbac);
          }
          $data['t_bac'] = self::upload($request, 't_bac');
          
      }
      $id=$data['id'];
      unset($data['id']);
      // dd($id);
      $res=DB::table('fishs')->where('id',$id)->update($data);
      if($res)
      {
        return redirect()->back()->with('success', '操作成功');
      }else
      {
        return redirect()->back()->with('error', '操作失败');
      }
    }
  // 鱼塘信息修改操作 结束

  // 鱼塘申请展示页 开始 
    public function getShenqing(Request $request)
      {
        $num = $request->input('num') ? $request->input('num') : 3;      
        $data=DB::table('shenqing')->paginate($num);      
        return view('Admin.Yutang.shenqing',['data'=>$data,'page' => $request->all()]);
      }
  // 鱼塘申请展示页 结束

  // 通过鱼塘申请 开始 
    public function getPass(Request $request)
    {
      // 接收数据 塘 用户 申请表 ID
        $t_id=$request->input('id');     
        $tz_id=$request->input('tz_id');     
        $shen_id=$request->input('sh_id');
      // 修改鱼塘表的塘主信息
        $res=DB::table('fishs')->where('id',$t_id)->update(['tz_id'=>$tz_id]);
      // 修改申请表的状态
        $dat=DB::table('shenqing')->where('id',$shen_id)->update(['status'=>'1']);
      // 修改用户的权限
        $ress=DB::table('user')->where('id',$tz_id)->update(['auth'=>'2']);
      // 发送消息通知
        $data['s_id']=$tz_id;
        $data['s_name']=DB::table('user')->where('id',$tz_id)->first()->username;
        $data['f_name']='管理员通知';
        $data['regdate']=time();
        $data['content']='您的鱼塘塘主申请已通过，注销登录开启塘主之旅！';
      // 插入通知表
        $res=DB::table('tongzhi')->insert($data);
        if($res && $data)
        {
          return redirect()->back()->with('success','操作成功');
        }else
        {
           return redirect()->back()->with('success','操作失败');
        }
    }
  // 通过鱼塘申请 结束

  // 拒绝鱼塘申请 开始
      public function getJujue(Request $request)
      {
        // 接收数据 塘名称 用户 申请表 ID
          $t_name=$request->input('name');     
          $id=$request->input('id');     
          $shen_id=$request->input('sh_id');
        // 发送消息通知
          $data['s_id']=$id;
          $data['s_name']=DB::table('user')->where('id',$id)->first()->username;
          $data['f_name']='管理员通知';
          $data['regdate']=time();
          $data['content']='您的鱼塘'.$t_name.'塘主申请未通过,继续努力吧！';
          $res=DB::table('tongzhi')->insert($data);
        // 改变申请的状态
          $dat=DB::table('shenqing')->where('id',$shen_id)->update(['status'=>'2']);
          if($res && $data)
          {
            return redirect()->back()->with('success','操作成功');
          }else
          {
             return redirect()->back()->with('success','操作失败');
          }
      }
  // 拒绝鱼塘申请 结束

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
            $request->file($picname)->move('./fish/',$name.'.'.$suffix);
            //返回路径
            return $name.'.'.$suffix;
        }
    }
  // 文件上传函数 结束

  // 鱼塘塘主活动 开始
       public function postHuodong(Request $request)
       {
            $data=$request->except('_token');
            $res=DB::table('huodong')->insert($data);
            if($res)
            {
                return redirect()->back()->with('success','操作成功');
            }else
            {
                return redirect()->back()->with('error','操作失败');
            }
       } 
  // 鱼塘塘主活动 结束

  // 鱼塘删除 开始
      public function getDelete(Request $request)
      {
          // 获取鱼塘的ID
            $id=$request->input('id');
          // 查询是否有塘主

          // 查询鱼塘成员

          // 查询鱼塘内商品
            
      }
  // 鱼塘删除 结束
}

