@extends('Admin.User.parent')
@section('title','消息列表')


@section('content')

<form action="/Admin/User/index" method="get">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            消息列表
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="dataTable_wrapper">
              <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="dataTables-example_wrapper">
            <div class="row">
            <div class="col-sm-6">
            <div id="dataTables-example_length" class="dataTables_length">
            <label>Show 
            <select class="form-control input-sm" aria-controls="dataTables-example" name="num">
            <option value="2">2</option><option value="5">5</option><option value="10">10</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div class="dataTables_filter" id="dataTables-example_filter">
            
            </div>
            </div>
            </div>
            <div class="row"><div class="col-sm-12">
            <table aria-describedby="dataTables-example_info" role="grid" class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
                    <thead>
                        <tr role="row">
                        <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 190px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting_asc">
                        发送者：
                        </th>
                        <th aria-label="Browser: activate to sort column ascending" style="width: 220px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
                        接收者：
                        </th>
                        <th aria-label="Platform(s): activate to sort column ascending" style="width: 201px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
                        内容
                        </th>
                        <th aria-label="Engine version: activate to sort column ascending" style="width: 164px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
                        发送时间</th>
                        <th aria-label="CSS grade: activate to sort column ascending" style="width: 119px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
                        操作</th></tr>
                    </thead>
                    <tbody>
                    @foreach($data as $v)
                        <tr role="row" class="gradeA odd">
                            <td class="sorting_1">{{$v->f_name}}</td>
                            <td>{{$v->s_name}}</td>
                            <td>{{$v->content}}</td>
                            <td class="center">{{date('Y-m-d',$v->regdate)}}</td>
                            <td class="center">
                                <a href="/Admin/Tongzhi/delete?id={{$v->id}}">删除</a>
                                | <a href="/Admin/Tongzhi/detail?id={{$v->id}}">详情</a>
                            </td>
                        </tr>
                     @endforeach   
                </table>
               {!! $data->appends($page)->render() !!}

                </div>
                </div>

            </div>
            <!-- /.table-responsive -->
           
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
</form>
<!-- /.col-lg-12 -->


@endsection