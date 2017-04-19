
<!-- 模版继承  -->
@extends('Admin.User.parent')
<!-- 标题 -->
@section('title','拍卖列表')
<!-- 头 -->
@section('header','拍卖列表')
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
       
      <form action="/Admin/Sale/index" method="get">
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
          <label>主题:<input type="search" name="title" class="form-control input-sm" placeholder="搜索" aria-controls="dataTables-example" /></label>
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
                        <th  style="width: 120px;" >
                        发布拍卖者
                        </th>
                        <th style="width: 150px;">
                        主题
                        </th>
                        <th style="width: 100px;">
                        拍卖底价</th>
                        <th style="width: 164px;">
                        拍卖时间</th>
                        <th  style="width: 164px;">
                        结束时间</th>
                         <th  style="width: 164px;">
                        介绍</th>
                         <th style="width: 164px;">
                        状态</th>
                         <th  style="width: 300px;">
                        操作</th>

            </tr> 
          </thead> 
          <tbody> 
                 @foreach($sales as $k=>$v)
                               <tr class="gradeA odd" role="row"> 
                                    <td class="sorting_1">{{$v->username}}</td> 
                                    <td>{{$v->title}}</td> 
                                    <td>{{$v->dprice}}</td> 
                                    <td>{{$v->stime}}</td> 
                                    <td>{{$v->ltime}}</td> 
                                    <td>{{$v->keyword}}</td> 
                                    <td>
                                      @if($v->b_id)
                                      已被拍下
                                      <a href="/Admin/Sale/paimaidetail?id={{$v->id}}&b_id={{$v->b_id}}">查看</a>
                                    </td>  
                                      @else
                                      未被拍下
                                      
                                    </td> 
                                    <td class="center">
                                        <a href="/Admin/Sale/picture?id={{$v->id}}">图 片</a>
                                       <a href="/Admin/Sale/edit?id={{$v->id}}">修改</a>
                                       <a href="/Admin/Sale/delete?id={{$v->id}}">删除</a>
                                    </td> 
                                    @endif
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
         {!! $sales->appends($all)->render() !!}
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
