@extends('Admin.User.parent')
@section('title','友情链接')
@section('content')

<form action="/Admin/Friendlink/index" method="get">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            友情链接
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="dataTable_wrapper">
              <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="dataTables-example_wrapper">
             <form action="/Admin/Friendlink/index" method="get">
               <div class="row">
                <div class="col-sm-6">
                 <div class="dataTables_length" id="dataTables-example_length">
                  <label> 显示<select name="num" aria-controls="dataTables-example" class="form-control input-sm">
                  <option value="2">2</option>
                  <option value="5">5</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  </select> 条</label>
                 </div>
                </div>
                <div class="col-sm-6">
                 <div id="dataTables-example_filter" class="dataTables_filter">
                  <label>名称:<input type="search" name="title" class="form-control input-sm" placeholder="搜索" aria-controls="dataTables-example" /></label>
                  <button class="btn btn-link" >搜索</button>
                 </div>
                </div>
               </div>
               </form>
            <div class="row"><div class="col-sm-12">
            <table aria-describedby="dataTables-example_info" role="grid" class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
                    <thead>
                        <tr role="row">
                        <th style="width: 190px;">
                        ID
                        </th>
                        <th style="width: 220px;">
                        链接名称
                        </th>
                        <th style="width: 220px;">
                        链接地址
                        </th>
                       
                        <th style="width: 220px;">
                        链接内容
                        </th>

                        <th style="width: 119px;">
                        操作</th></tr>
                    </thead>
                    <tbody>
                    @foreach($res as $k=>$v)
                        <tr role="row" class="gradeA odd">
                            <td class="sorting_1">{{$v->id}}</td>
                            <td>{{$v->linkname}}</td>
                            <td>{{$v->url}}</td>
                           
                            <td>{{$v->content}}</td>
                            <td>
                                <a href="/Admin/Friendlink/delete?id={{$v->id}}">删除</a> |
                                <a href="/Admin/Friendlink/edit?id={{$v->id}}">修改</a>   
                            </td>
                        </tr>
                     @endforeach   
                </table>
                </div>
                </div>

            </div>
            <!-- /.table-responsive -->
             {!! $res->appends($all)->render() !!}
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
</form>
<!-- /.col-lg-12 -->


@endsection
