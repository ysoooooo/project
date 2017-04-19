@extends('Admin.User.parent')
@section('title','塘主申请列表')


@section('content')

<form action="/Admin/User/index" method="get">
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
            </div>
            </div>
            </div>
            <div class="row"><div class="col-sm-12">
            <table aria-describedby="dataTables-example_info" role="grid" class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>申请者</th>
                            <th>申请的塘</th>
                            <th>申请时间</th>
                            <th>状态</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $k=>$v)
                        <tr role="row" class="gradeA odd">
                            <td class="sorting_1">{{$v->user_name}}</td>
                            <td>
                                {{$v->fish_name}}
                            </td>
                            <td>{{date('Y-m-d h:i:s',$v->time)}}</td> 
                            <td>
                            @if($v->status=='1')
                                已通过
                            @elseif($v->status=='0')
                                待处理 　　　<a href="/Admin/Yutang/pass?id={{$v->fish_id}}&tz_id={{$v->user_id}}&sh_id={{$v->id}}"><button type="button" class="btn btn-success">通过</button></a>
                            　　　　　　　<a href="/Admin/Yutang/jujue?name={{$v->fish_name}}&id={{$v->user_id}}&sh_id={{$v->id}}"><button type="button" class="btn btn-danger">拒绝</button></a>
                            @else($v->status=='2')
                                已拒绝                 
                            @endif         
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