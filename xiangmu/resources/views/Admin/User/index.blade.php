@extends('Admin.User.parent')
@section('title','用户列表')


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
            <label><input aria-controls="dataTables-example" placeholder="" class="form-control input-sm" type="search" name="keyword"></label>  　　　<button  class="btn btn-primary">搜索</button>
            </div>
            </div>
            </div>
            <div class="row"><div class="col-sm-12">
            <table aria-describedby="dataTables-example_info" role="grid" class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
                    <thead>
                        <tr role="row">
                        <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 190px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting_asc">ID
                        </th>
                        <th aria-label="Browser: activate to sort column ascending" style="width: 220px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
                        用户名
                        </th>
                        <th aria-label="Platform(s): activate to sort column ascending" style="width: 201px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
                        权限</th>
                        <th aria-label="Engine version: activate to sort column ascending" style="width: 164px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
                        创建时间</th>
                        <th aria-label="CSS grade: activate to sort column ascending" style="width: 119px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
                        操作</th></tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr role="row" class="gradeA odd">
                            <td class="sorting_1">{{$user->id}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->auth}}</td>
                            <td class="center">{{date('Y-m-d',$user->created_at)}}</td>
                            <td class="center">
                            @if($user->auth=='超级管理员')
                            	<a href="/Admin/User/detail?id={{$user->id}}">详情</a>
                            @elseif($user->auth=='管理员'&& session('hauth')=='3')	
                		 		<a href="/Admin/User/detail?id={{$user->id}}">详情</a> |
							@else
                		 		<a href="/Admin/User/detail?id={{$user->id}}">详情</a> |
	                    		<a href="/Admin/User/delete?id={{$user->id}}" class="del" sid="{{$user->id}}"
	                             >删除</a> |
	                    		<a href="/Admin/User/edit?id={{$user->id}}">修改</a>	 
                            @endif
                            </td>
                        </tr>
                     @endforeach   
                </table>
               {!! $users->appends($page)->render() !!}

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
<script>
    $('.del').click(function(){
        var id=$(this).attr('sid');
        var link=$(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post('/Admin/User/delete',{id:id},function(data){
                if(data==1)
                {
                    if(confirm('确定要删除吗')==false) 
                    {return false};
                    link.parents('tr').remove();
                }
        })
        return false;
    })
</script>
    

@endsection