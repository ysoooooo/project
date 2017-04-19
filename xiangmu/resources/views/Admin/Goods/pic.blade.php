@extends('Admin.User.parent')
@section('title','商品图片页面')
@section('content')
<form action="/Admin/Goods/index" method="post">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                商品图片
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <div class="dataTables_wrapper form-inline dt-bootstrap no-footer"
                         id="dataTables-example_wrapper">
                        <div class="row">
                            <div class="col-sm-6">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <table aria-describedby="dataTables-example_info" role="grid"
                                   class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="dataTables-example">
                                <thead>
                                @foreach($res as $v)
                                    <th>
                                        <img src="/goods/{{$v->pic}}" width="100px">
                                        <a href="/Admin/Goods/picdel?id={{$v->id}}">图片删除</a> <br>
                                        <a href="/Admin/Goods/picedit?id={{$v->id}}">图片修改</a>
                                    </th>
                                @endforeach
                                </thead>
                                <tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


@endsection
