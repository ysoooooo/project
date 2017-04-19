
<!-- 模版继承  -->
@extends('Admin.User.parent')
<!-- 标题 -->
@section('title','拍卖详情')
<!-- 头 -->
@section('header','拍卖详情')
<!-- 添加内容 -->
@section('content')

  <div class="col-lg-12"> 
   <div class="panel panel-default"> 
   
    <div class="panel-body"> 
     <div class="dataTable_wrapper"> 
      <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
       
     
       <div class="row">
        <div class="col-sm-6">
         <div class="dataTables_length" id="dataTables-example_length">
          
         </div>
        </div>
        <div class="col-sm-6">
         <div id="dataTables-example_filter" class="dataTables_filter">
          
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
                  拍卖商品名：
              </th>
              <td>
                {{$data['pname']}}
              </td>
            </tr> 
            <tr role="row">
              <th  style="width: 120px;" >
                  拍卖获得者：
              </th>
              <td>
                {{$data['username']}}
              </td>
            </tr> 
            <tr role="row">
              <th  style="width: 120px;" >
                  成交价格：
              </th>
              <td>
                {{$data['price']}}元
              </td>
            </tr> 

            <tr role="row">
              <th  style="width: 120px;" >
                  拍卖状态：
              </th>
              <td>
                @if($data['status'])
                  已付款
                @else
                  未付款
                @endif    
              </td>
            </tr>   
           
          </thead> 
        
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
