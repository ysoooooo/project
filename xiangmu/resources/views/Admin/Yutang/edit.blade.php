@extends('Admin.User.parent')
@section('title','fish编辑')
@section('content')



<div class="panel-body">
    <div class="row">
    <!-- 验证 开始 -->
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                <li>{{ $errors->first() }}</li>
            </ul>
        </div>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    <!-- 验证 结束 -->
        <div class="col-lg-6 col-lg-offset-3">
        <!--后台管理员添加用户表单  开始-->
        <div class="form-group">
                    <label class="control-label">塘主名称: 
                    @if(isset($tz_name))
                        {{$tz_name}}
                    @else
                        暂无塘主
                            @if(isset($res))
                                塘主征集令进行中
                            @else
                            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#zhengji">
                                发布塘主征集令
                            </button>
                            @endif

                    @endif    
                    </label>  
        </div>
            <form role="form" method="post" action="/Admin/Yutang/update" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{$data->id}}">

              

                <div class="form-group">
                    <label>所属类别:</label>
                    <select class="form-control" name="cate_id" id="aaaaa">
                      @foreach($catelist as $k=>$v)
                            @if($v->id == $data->cate_id)
                                 <option value="{{$v->id}}" selected=""  >{{$v->name}}</option>
                            @else
                                 <option value="{{$v->id}}"  >{{$v->name}}</option>
                                
                            @endif
                      @endforeach
                    </select>
                   
                </div> 

                <div class="form-group">
                    <label class="control-label">鱼塘名称:</label>
                    <input class="form-control"name="t_name"type="text" value="{{$data->t_name}}" required="required" class="form-control" value="{{old('name')}}">  
                </div>

                <div class="form-group">
                    <label>塘logo：</label>
                    <img src="/fish/{{$data->t_pic}}" alt="" style="width:200px;">
                    <input type="hidden" name="old_t_pic" value="{{$data->t_pic}}">
                    <input type="file" name="t_pic">
                </div>

                <div class="form-group">
                    <label>塘bac：</label>
                    <img src="/fish/{{$data->t_bac}}" alt="" style="width:200px;">
                    <input type="hidden" name="old_t_bac" value="{{$data->t_bac}}">
                    <input type="file" name="t_bac">
                </div>

                 <div class="form-group">
                    <label class="control-label">t_title:</label>
                    <input class="form-control"name="t_title"type="text" value="{{$data->t_title}}" required="required" class="form-control" value="{{old('name')}}">  
                </div>

                    {{ csrf_field() }}

                <button type="submit" class="btn btn-default">编辑</button>
               
            </form>
        <!--后台管理员添加用户表单  结束-->
        </div>
    </div>
    <!-- /.row (nested) -->
</div>

    <!-- 塘主征集令模态框 开始 -->

<!-- Modal -->
<div class="modal fade" id="zhengji" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
    <form method="post" action="/Admin/Yutang/huodong" role="form">

      <div class="modal-body">
            <div class="form-group">
                 <label>结束时间</label>

        <input placeholder="输入结束时间" type="text" value="{{old('ltime')}}" onfocus="WdatePicker({ dateFmt:'yyyy/MM/dd HH:mm:ss',minDate:'#F{$dp.$D(\'commentdatemin\')}' })" id="commentdatemin" name="ltime" class="form-control">                      
                        {{ csrf_field() }}
                  <input type="hidden" name="t_name" value="{{$data->t_name}}">
                  <input type="hidden" name="t_id" value="{{$data->id}}">
                        
            </div>
   
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-primary">确定</button>
      </div>
    </form>  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <!-- 塘主征集令模态框 结束 -->

@endsection
