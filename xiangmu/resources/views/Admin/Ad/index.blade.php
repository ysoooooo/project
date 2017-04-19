
<!-- 模版继承  -->
@extends('Admin.User.parent')
<!-- 标题 -->
@section('title','广告列表')
<!-- 头 -->
@section('header','广告列表')
<!-- 添加内容 -->
@section('content')

  <div class="col-lg-12"> 
   <div class="panel panel-default"> 
   <!--  <div class="panel-heading">
      DataTables Advanced Tables 
    </div>  -->
    <!-- /.panel-heading --> 
    <div class="panel-body"> 
     <div class="dataTable_wrapper"> 
      <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
       
      <form action="/Admin/Ad/index" method="get">
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
          <label>用户名:<input type="search" name="title" class="form-control input-sm" placeholder="" aria-controls="dataTables-example" /></label>
          <button class="btn btn-link" >搜索</button>
         </div>
        </div>
       </div>
       </form>
       <div class="row">
        <div class="col-sm-12">
         <table id="dataTables-example" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dataTables-example_info"> 
          <thead> 
           <tr role="row">
                        <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 190px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting_asc">ID
                        </th>
                        <th aria-label="Browser: activate to sort column ascending" style="width: 220px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
                        主题
                        </th>
                         <th aria-label="Engine version: activate to sort column ascending" style="width: 164px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
                        介绍</th>
                         <th aria-label="Engine version: activate to sort column ascending" style="width: 164px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
                        链接</th>
                         <th aria-label="Engine version: activate to sort column ascending" style="width: 164px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
                        图片</th>
                        <th aria-label="CSS grade: activate to sort column ascending" style="width: 119px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">
                        操作</th>
            </tr> 
           
          </thead> 
          <tbody> 
         @foreach($ads as $k=>$v)
                       <tr class="gradeA odd" role="row"> 
                            <td class="sorting_1">{{$v->id}}</td> 
                            <td>{{$v->title}}</td> 
                            <td>{{$v->explain}}</td> 
                            <td>{{$v->link}}</td> 
                            <td class="center">
                              <img src="{{$v->pic}}" width="50px">
                            </td> 
                            <td class="center">
                                <a href="/Admin/Ad/edit?id={{$v->id}}">修改</a>
                                <a href="/Admin/Ad/delete?id={{$v->id}}">删除</a>
                            </td> 
                       </tr>
                     @endforeach   
          </tbody> 
         </table>
        </div>
       </div>
       <div class="row">
        <div class="col-sm-6">
       <!--   <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">
          Showing 1 to 10 of 57 entries
         </div> -->
        </div>
        <div class="col-sm-6">
       {!! $ads->appends($all)->render() !!}
        </div>
       </div>
      </div> 
     </div> 
     <!-- /.table-responsive --> 
    </div> 
    <!-- /.panel-body --> 
   </div> 
   <!-- /.panel --> 
  </div>

            
@endsection
