@extends('Admin.User.parent')
@section('title','商品列表')
@section('content')
<div class="panel-body">
    <div class="row">
         <div class="col-lg-6">
             <div class="panel panel-default">
                 <div class="panel-heading">
                     商品列表
                 </div>
                 <!-- /.panel-heading -->
                 <div class="panel-body">
                     <div class="table-responsive table-bordered">
                         <table class="table">
                             <thead>
                             @foreach($res as $v)
                                 @if($v->path=='0')
                                 <tr style="background:pink" class="ff">
                                   @else 
                                  <tr class="ff">
                                 @endif   
                                     <th class="xiugai">{{$v->name}}</th>
                                     <th>
                                     <button class="deletecate btn btn-danger" sid="{{$v->id}}">删除</button>　
                                     <button class="edit btn btn-success" xid="{{$v->id}}">修改</button>
                                    </th>
                                    
                                 </tr>
                             @endforeach    
                             </thead>
                             
                         </table>
                     </div>
                     <!-- /.table-responsive -->
                 </div>
                 <!-- /.panel-body -->
             </div>
             <!-- /.panel -->
         </div>      
    </div>
    <!-- /.row (nested) -->
</div>
@endsection
@section('js')
    <script>
        $('.deletecate').click(function(){
            var id=$(this).attr('sid');
            var link=$(this);
             $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            $.post('/Admin/Cate/delete',{id:id},function(data){
                if(data=='1'){
                    link.parents('.ff').remove();
                    
                }
            });
            
        }); 
        $('.edit').click(function(){
             $(this).unbind('click');
             var th=$(this).parents('.ff').find('.xiugai');
             var yname = th.html();
             var id=$(this).attr('xid');
             var links=$(this);
             var inp=$('<input class="form-control" type="text" value="'+yname+'">');
             th.empty().append(inp);
                inp.blur(function(){

                    var name = $(this).val();
                    $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    });
                    $.post('/Admin/Cate/edit',{id:id,name:name},function(data){
                        if(data == 1)
                        {
                            //修改成功后
                            th.empty().html(name);
                        }else
                        {
                            //修改失败后
                            th.empty().html(yname);
                        }
                    })
                })
             
        })   
    </script>
@endsection