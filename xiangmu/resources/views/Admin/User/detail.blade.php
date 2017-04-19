@extends('Admin.User.parent')
@section('title','用户详情')


@section('content')


<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            用户详情
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="dataTable_wrapper">
<!--详情页表格 开始-->
    <table aria-describedby="dataTables-example_info" role="grid" class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
     
        <tr role="row">
        <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" 
        style="width: 190px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" 
        class="sorting_asc">ID</th>
        <th class="sorting_1">{{$user->id}}</th>
        <tr/>
        <tr role="row">
        <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" 
        style="width: 190px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" 
        class="sorting_asc">用户名</th>
        <th class="sorting_1">{{$user->username}}</th>
        <tr/>   
        <tr role="row">
        <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" 
        style="width: 190px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" 
        class="sorting_asc">头像</th>
        <th class="sorting_1"><img src="/uploads/{{$user->pic}}" width="100px"></th>
        <tr/>                
         <tr role="row">
         <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" 
         style="width: 190px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" 
         class="sorting_asc">性别</th>
         <th class="sorting_1"> @if($userdetails->sex == 0 ) 
                                    女
                                @elseif($userdetails->sex == 1)
                                    男
                                @else
                                    未知
                                @endif</th>
         <tr/>                 
                              
        <tr role="row">
        <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" 
        style="width: 190px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" 
        class="sorting_asc">昵称</th>
        <th class="sorting_1">{{$userdetails->uname}}</th>
        <tr/>

        <tr role="row">
        <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" 
        style="width: 190px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" 
        class="sorting_asc">居住地址</th>
        <th class="sorting_1">{{$userdetails->address}}</th>
        <tr/>  

        <tr role="row">
        <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" 
        style="width: 190px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" 
        class="sorting_asc">创建时间</th>
        <th class="sorting_1">{{date('Y-m-d',$user->created_at)}}</th>
        <tr/>                   
                               
          <tr role="row">
        <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" 
        style="width: 190px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" 
        class="sorting_asc">修改时间</th>
        <th class="sorting_1">{{date('Y-m-d',$user->update_at)}}</th>
        <tr/>                                                
    </table>
<!--详情页表格 结束 -->
                </div>
              

            </div>
            <!-- /.table-responsive -->
           
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<!-- /.col-lg-12 -->


@endsection