@extends('Admin.User.parent')
@section('title','后台首页')
@section('content')
    
<!--后台页面继承模块 开始  -->
    @section('content')      
        <div class="panel-body">
            <ul class="timeline">
               <li>
                   <div class="timeline-badge"><i class="fa fa-check"></i>
                   </div>
                   <div class="timeline-panel">
                       <div class="timeline-heading">
                           <h4 class="timeline-title">鱼塘</h4>
                           <p><i class="fa fa-clock-o"></i> 
                           鱼塘个数:{{ $numfish }}个</small>
                           </p>
                       </div>
                       <div class="timeline-body">
                           <p>最新鱼塘名称</p>
                       </div>
                    @foreach ($fishs as $k)
                       <div>
                           <a href="/Admin/parent/fishs"><h3><button type="button" class="btn btn-success">{{ $k->t_name }}</button></h3></a>
                       </div>
                    @endforeach   
                                    
               </li>
               <li class="timeline-inverted">
                   <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
                   </div>
                   <div class="timeline-panel">
                       <div class="timeline-heading">
                           <h4 class="timeline-title">拍卖</h4>
                        <p>
                            <i class="fa fa-clock-o"></i> 
                             拍卖商品个数:{{ $numsale }}个
                        </p>
                        </div>
                        <div class="timeline-body">
                            <p>最新拍卖商品</p>
                        </div>
                      @foreach ($sales as $k)
                         <div>
                             <a href="/Admin/parent/sales"><h3><button type="button" class="btn btn-warning">{{ $k->title }}</button></h3></a>
                         </div>
                      @endforeach
               </li>
               <li>
                   <div class="timeline-badge danger"><i class="fa fa-bomb"></i>
                   </div>
                   <div class="timeline-panel">
                       <div class="timeline-heading">
                           <h4 class="timeline-title">商品</h4>
                       <p>
                           <i class="fa fa-clock-o"></i> 
                            商品个数:{{ $numgood }}个
                       </p>
                       </div>
                       <div class="timeline-body">
                           <p>最新商品</p>
                       </div>
                     @foreach ($goods as $k)
                        <div>
                            <a href="/Admin/parent/goods"><h3><button type="button" class="btn btn-danger">{{ $k->goodstitle }}</button></h3></a>
                        </div>
                     @endforeach
               </li>
               <li class="timeline-inverted">
                   <div class="timeline-panel">
                       <div class="timeline-heading">
                           <h4 class="timeline-title">用户</h4>
                       <p>
                           <i class="fa fa-clock-o"></i> 
                            用户总数:{{ $numuser }}个
                       </p>
                       </div>
                       <div class="timeline-body">
                           <p>最新注册用户</p>
                       </div>
                     @foreach ($users as $k)
                        <div>
                            <a href="/Admin/parent/users"><h3><button type="button" class="btn btn-info">{{ $k->username }}</button></h3></a>
                        </div>
                     @endforeach
               </li>
              
            </ul>
        </div>
    @endsection 
@section('js')

@show