 @extends('Admin.User.parent')
@section('title','轮播图')
@section('content')

<form action="/Admin/User/index" method="get">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            轮播图
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="dataTable_wrapper">
              <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="dataTables-example_wrapper">
            <div class="row"><div class="col-sm-12">
            <table aria-describedby="dataTables-example_info" role="grid" class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
                    <thead>
                        <tr role="row">
                        <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 190px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting_asc">
                        ID
                        </th>
                        <div class="form-group">
                    	<th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 190px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting_asc">
                        轮播图
                        </th>
                        <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 190px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting_asc">
                        商品类别
                        </th>
                		</div>
                        <th aria-label="CSS grade: activate to sort column ascending" style="width: 119px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
                        操作</th></tr>
                    </thead>
                    <tbody>
                    @foreach($res as $k=>$v)
                        <tr role="row" class="gradeA odd">
                            <td class="sorting_1">{{$v->id}}</td> 
                            <td>
                               <img src="/config/{{$v->pic}}" width="50px">
                            </td>
                            <td class="sorting_1">{{$v->name}}</td>
                            <td>
                                <a href="/Admin/Lunbo/edit?id={{$v->id}}">修改</a>   
                            </td>
                        </tr>
                     @endforeach   
                </table>
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

