@extends('Admin.User.parent')
@section('title','商品列表页面')
@section('content')
    <form action="/Admin/Goods/index" method="get">
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
                                        <tr role="row">
                                            <th style="width: 100px;">ID
                                            </th>
                                            <th style="width: 120px;">
                                                类别名
                                            </th>
                                            <th  style="width: 180px">
                                                所属鱼塘名
                                            </th>
                                            <th 
                                                style="width: 220px;">
                                                商品名称
                                            </th>
                                            <th 
                                                style="width: 201px;">
                                                商品介绍
                                            </th>
                                            <th 
                                                style="width: 201px;">
                                                卖家
                                            </th>
                                            <th
                                                style="width:150px;">
                                                状态
                                            </th>
                                            <th 
                                                style="width:120px;">
                                                商品价格
                                            </th>
                                            <th 
                                                style="width: 164px;" 
                                               >
                                                创建时间
                                            </th>
                                            <th 
                                                style="width: 300px;" 
                                                >
                                                操作
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($res as $v)
                                            <tr role="row" class="gradeA odd">
                                                <td class="sorting_1">{{$v->id}}</td>
                                                <td class="sorting_1">{{$v->name}}</td>
                                                <td class="sorting_1">{{$v->t_name}}</td>
                                                <td class="sorting_1">{{$v->goodsname}}</td>
                                                <td class="sorting_1">{{$v->goodstitle}}</td>
                                                <td class="sorting_1">{{$v->username}}</td>
                                                <td class="sorting_1">
                                                @if($v ->b_id)
                                                    已售出
                                                @else
                                                    正在销售
                                                @endif
                                                </td>
                                                <td class="sorting_1">{{$v ->price}}</td>
                                                <td class="sorting_1">{{date('Y-m-d',$v->created_at)}}</td>

                                                <td class="sorting_1">
                                                    <a href="/Admin/Goods/picture?id={{$v->id}}">图 片</a>|
                                                    <a href="#" class="delgoods" sid="{{$v->id}}">删 除</a>|
                                                    <a href="/Admin/Goods/edit?id={{$v->id}}">修 改</a>
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
        //给所有的删除绑定事件
        $('.delgoods').click(function () {
            //获取删除ID
            var id = $(this).attr('sid');
            // alert(id);
            var links = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                url: '/Admin/Goods/delete',
                type: 'post',
                data: {id: id},
                success: function (data) {
                    // alert(data);
                    if (data) 
                    {
                        alert('删除成功');
                        links.parents('tr').remove();
                    }
                },
                async: true
            })
            return false;
        })

    </script>
@endsection