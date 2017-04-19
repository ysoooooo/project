@extends('Admin.User.parent')
@section('title','评论页面')
@section('content')
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
    <form action="/Admin/TalkGoods/index" method="get">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    商品列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer"
                             id="dataTables-example_wrapper">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div id="dataTables-example_length" class="dataTables_length">
                                        <label>显示
                                            <select class="form-control input-sm" aria-controls="dataTables-example"
                                                    name="num">
                                                <option value="2">2</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="100">100</option>
                                            </select> 条
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="dataTables_filter" id="dataTables-example_filter">
                                        <label>
                                            <input aria-controls="dataTables-example" placeholder="请输入关键字"
                                                   class="form-control input-sm" type="search" name="key">
                                        </label> 　　　
                                        <button class="btn btn-primary">搜索</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table aria-describedby="dataTables-example_info" role="grid"
                                           class="table table-striped table-bordered table-hover dataTable no-footer"
                                           id="dataTables-example">
                                        <thead>
                                        <tr role="row" align="center">
                                            <th  style="width: 105px;" >商品评论ID
                                            </th>
                                            
                                            <th style="width: 250px;"  >
                                                评 论 内 容
                                            </th>
                                            
                                            <th style="width: 100px;" >
                                                层级
                                            </th>
                                            <th style="width: 160px;" >
                                                商品名
                                            </th>
                                            <th style="width: 100px;" >
                                                用户名
                                            </th>
                                            <th style="width: 100px;" >
                                                用户头像
                                            </th>
                                            <th style="width: 100px;" >
                                                评论时间
                                            </th>
                                            <th style="width: 80px;" >
                                                显示状态
                                            </th>
                                            <th style="width: 160px;" >
                                                操作
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($res as $v)
                                            <tr role="row" class="gradeA odd" align="center">
                                                <td class="sorting_1">{{$v ->id}}</td>
                                                <td class="sorting_1">{{$v ->content}}</td>
                                                <td class="sorting_1">{{$v ->lays}}</td>
                                                <td class="sorting_1">{{$v ->productname}}</td>
                                                <td class="sorting_1">{{$v ->uname}}</td>
                                                <td class="sorting_1">
                                                <img src="/uploads/{{$v->upic}}" alt="" style="width:100px;height:50px">
                                                </td>
                                                <td class="sorting_1">{{date('Y-m-d',$v->rtime)}}</td>
                                                <td>
                                                    <a class="updatestatus" sid="{{$v->id}}">
                                                        <span class = "statu"><button class="btn" type="button">{{$v->status==1?'屏蔽':'显示'}}</button>
                                                        </span> 
                                                    </a>
                                                </td>

                                                <td class="sorting_1">
                                                    <a href="/Admin/TalkGoods/edit?id={{$v ->id}}"><button class="btn btn-success" type="button">修改</button></a>
                                                    <a href="/Admin/TalkGoods/delete?id={{$v->id}}"><button class="btn btn-warning" type="button">删除</button></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! $res->appends($all)->render() !!}
                </div>
            </div>
    </form>


@endsection
@section('js')
    <script>
        //给所有的状态绑定事件
        $('.updatestatus').click(function () {
            //获取删除ID
            var id = $(this).attr('sid');
            var statu = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.post('/Admin/TalkGoods/updatesta',{id:id},function(data){
                
                if(data=='1')
                {   
                    statu.find('.btn').html('屏蔽').css('color','red');
                }else
                {
                    
                    statu.find('.btn').html('显示').css('color','green');
                }
            })
        })

    </script>
@endsection