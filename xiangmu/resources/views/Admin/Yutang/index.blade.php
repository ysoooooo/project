@extends('Admin.User.parent')
@section('title','fish列表')


@section('content')

<form action="/Admin/Yutang/index" method="get">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            用户列表
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
            <label><input aria-controls="dataTables-example" placeholder="" class="form-control input-sm" type="search" name="keyword"></label>  　　　<button  class="btn btn-primary">搜索</button>
            </div>
            </div>
            </div>
            <div class="row"><div class="col-sm-12">
            <table aria-describedby="dataTables-example_info" role="grid" class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>塘主</th>
                            <th>塘名称</th>
                            <th>塘logo</th>
                            <th>塘的介绍</th>
                            <th>所属分类</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $k=>$v)
                        <tr role="row" class="gradeA odd">
                            <td class="sorting_1">{{$v->id}}</td>
                            <td>
                                @if($v->tz_id)
                                    有塘主
                                @else
                                    无塘主    
                                @endif
                            </td>
                            <td>{{$v->t_name}}</td>
                            
                            <td><img src="/fish/{{$v->t_pic}}" style="width:100px;height:100px;" alt=""></td>
                            <td>{{$v->t_title}}</td>
                            <td>{{$v->cate_id}}...{{$v->name}}</td>
                            <td>
                                <a href="/Admin/Yutang/edit?id={{$v->id}}">编辑</a> |
                                <a href="/Admin/Yutang/delete?id={{$v->id}}">删除</a> 
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
@section('js')
@endsection