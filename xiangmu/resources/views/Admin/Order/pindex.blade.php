 @extends('Admin.User.parent')
@section('title','拍卖订单管理')
@section('content')

<form action="/Admin/User/index" method="get">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            拍卖商品订单
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="dataTable_wrapper">
              <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="dataTables-example_wrapper">
            <div class="row"><div class="col-sm-12">
            <table aria-describedby="dataTables-example_info" role="grid" class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
                    <thead>
                        <tr role="row">
                        <th style="width: 35px;" >
                        ID
                        </th>
                        <div class="form-group">
                    	<th style="width: 70px;" >
                        订单号
                        </th>
                       <th style="width: 110px;" >
                        商品名称
                        </th>
                       <th style="width: 100px;" >
                        成交价格
                        </th>
                       <th style="width: 100px;" >
                        发货人
                        </th>
                      <th style="width: 110px;" >
                        收货人姓名
                        </th>
                       <th style="width: 190px;" >
                        收货人地址
                        </th>
                      <th style="width: 210px;" >
                        状态
                        </th>
                		</div>
                       <th style="width: 100px;" >
                        操作</th></tr>
                    </thead>
                    <tbody>
                    @foreach($res as $k=>$v)
                        <tr role="row" class="gradeA odd">
                            <td class="sorting_1">{{$v->id}}</td> 
                            <td class="sorting_1">{{$v->numbers}}</td>
                            <td class="sorting_1">{{$v->title}}</td>
                            <td class="sorting_1">{{$v->price}}元</td> 
                            <td class="sorting_1">{{$v->username}}</td>
                            <td class="sorting_1">{{$v->shouname}}</td> 
                            <td class="sorting_1">{{$v->address}}</td>
                            <td class="sorting_1">  
                                    @if($v->status == 0)
                                        已付款(未填写收货地址）
                                    @elseif($v->status == 1)
                                        已填写收货地址
                                    @elseif($v->status == 2)                                
                                        已发货
                                    @elseif($v->status == 3)
                                        已完成
                                    @endif
                            </td>

                            <td>
                                <a href="/Admin/Order/pdel?id={{$v->id}}">删除</a>   
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
