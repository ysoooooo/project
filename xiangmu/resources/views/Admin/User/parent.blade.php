<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>后台管理</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('/admins/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="/uploads/6.ico" rel="icon">
    <!-- MetisMenu CSS -->
    <link href='{{asset("/admins/bower_components/metisMenu/dist/metisMenu.min.css")}} 'rel="stylesheet">

    <!-- Timeline CSS -->
    <link href='{{asset("/admins/dist/css/timeline.css")}}' rel="stylesheet">

    <!-- Custom CSS -->
    <link href='{{asset("/admins/dist/css/sb-admin-2.css")}} 'rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href='{{asset("/admins/bower_components/morrisjs/morris.css")}} 'rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href='{{asset("/admins/bower_components/font-awesome/css/font-awesome.min.css")}} 'rel="stylesheet" type="text/css">

    <script src="/admins/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/homes/lib/My97DatePicker/4.8/WdatePicker.js"></script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
               
                <a class="navbar-brand" >man.cn 后台　　　 你好！{{session('hname')}}　</a>　
                　
            </div>
           
            <!-- /.navbar-header -->
        
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend/admins.</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
        
                        <li class="divider"></li>
                        <li><a href="/Admin/User/logout"><i class="fa fa-sign-out fa-fw"></i>退出登录</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
<!--侧边菜单 开始  -->
    <ul class="nav" id="side-menu">
        <li class="sidebar-search">
            <div class="input-group custom-search-form">
               　　　　　　
            </div>
        </li>
        <!--后台首页 开始 -->
            <li>
                <a href="/Admin/parent/parent"><i class="fa fa-dashboard fa-fw"></i> 后台首页</a>
            </li>
        <!--后台首页 结束 -->    
        <!--后台用户管理模块 开始 -->
            <li>
                <a href="#"><i class="fa  fa-user  fa-fw"></i> 用户操作<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/Admin/User/index">用户列表</a>
                    </li>
                    <li>
                        <a href="/Admin/User/add">用户添加</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        <!--后台用户管理模块 结束 -->
        
        <!--后台商品分类管理模块 开始 -->
            <li>
                <a href="#"><i class="fa   fa-bar-chart-o   fa-fw"></i> 商品分类<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/Admin/Cate/index">分类列表</a>
                    </li>
                    <li>
                        <a href="/Admin/Cate/add">分类添加</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        <!--后台商品分类管理模块 结束 -->

        <!-- 后台商品管理模块 开始-->
            <li>
                <a href="#"><i class="fa fa-twitter-square"></i> 商品管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/Admin/Goods/index">商品列表</a>
                    </li>
                    <li>
                        <a href="/Admin/Goods/add">商品添加</a>
                    </li>
                </ul>
            </li>        
        <!-- 后台商品管理模块 结束-->

        <!--后台轮播图模块 开始 -->
            <li>
                <a href="#"><i class="fa fa-reddit-square"></i>  轮播图<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/Admin/Lunbo/index">轮播列表</a>

                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        <!--后台轮播图模块 结束 -->

        <!-- 后台消息管理模块 开始-->
            <li>
                <a href="#"><i class="fa fa-folder-open"></i> 通知消息管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/Admin/Tongzhi/list">消息列表</a>
                    </li>
                </ul>
            </li>
        <!-- 后台消息管理模块 结束-->

        <!-- 后台商品评论管理模块 开始-->
            <li>
                <a href="#"><i class="fa fa-inbox"></i> 评论管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/Admin/TalkGoods/index">评论列表</a>
                    </li>
                </ul>
            </li>
        <!-- 后台商品评论管理模块 结束-->

        <!--后台友情链接模块 开始 -->
            <li>
                <a href="#"><i class="fa fa-heart"></i> 友情链接<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/Admin/Friendlink/index">链接列表</a>
                    </li>
                    <li>
                        <a href="/Admin/Friendlink/add">添加链接</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        <!--后台友情链接模块 结束 -->

        <!--后台网站配置模块 开始 -->
            <li>
                <a href="#"><i class="fa fa-desktop"></i> 网站配置 <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/Admin/Config/index">网站配置</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        <!--后台网站配置模块 结束 -->

        <!--后台鱼塘管理模块 开始 -->
            <li>
                <a href="#"><i class="fa fa-jsfiddle"></i> 鱼塘管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/Admin/Yutang/index">鱼塘列表</a>
                    </li>
                    <li>
                        <a href="/Admin/Yutang/add">添加鱼塘</a>
                    </li>
                    <li>
                        <a href="/Admin/Yutang/shenqing">申请列表</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        <!--后台鱼塘管理模块 结束 -->

        <!--后台拍卖管理模块 开始 -->
            <li>
                <a href="#"><i class="fa fa-gift"></i> 拍卖管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/Admin/Sale/index">拍卖列表</a>
                    </li>
                    <li>
                        <a href="/Admin/Sale/add">拍卖添加</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        <!--后台拍卖管理模块 结束 -->

        <!--后台广告管理模块 开始 -->
            <li>
                <a href="#"><i class="fa fa-asterisk"></i> 广告管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/Admin/Ad/index">广告列表</a>
                    </li>
                    <li>
                        <a href="/Admin/Ad/add">广告添加</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        <!--后台广告管理模块 结束 -->

        <!-- 后台订单管理模块 开始-->
            <li>
                <a href="#"><i class="fa fa-suitcase"></i> 订单管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/Admin/Order/index">商品订单列表</a>
                    </li>
                    <li>
                        <a href="/Admin/Order/pindex">拍卖订单列表</a>
                    </li>
                </ul>
            </li>
        <!-- 后台订单管理模块 结束-->


    </ul>
<!--侧边菜单 结束  -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> @yield('title')</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<!--后台操作提示信息 开始  -->
    @if(session('success'))
        <div class="alert  alert-info">
            {{session('success')}}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
<!--后台操作提示信息 结束 -->
    
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
                           <p><small class="text-muted"><i class="fa fa-clock-o"></i> 11 hours ago via Twitter</small>
                           </p>
                       </div>
                       <div class="timeline-body">
                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero laboriosam dolor perspiciatis omnis exercitationem. Beatae, officia pariatur? Est cum veniam excepturi. Maiores praesentium, porro voluptas suscipit facere rem dicta, debitis.</p>
                       </div>
                   </div>
               </li>
               <li class="timeline-inverted">
                   <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
                   </div>
                   <div class="timeline-panel">
                       <div class="timeline-heading">
                           <h4 class="timeline-title">拍卖</h4>
                       </div>
                       <div class="timeline-body">
                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolorem quibusdam, tenetur commodi provident cumque magni voluptatem libero, quis rerum. Fugiat esse debitis optio, tempore. Animi officiis alias, officia repellendus.</p>
                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium maiores odit qui est tempora eos, nostrum provident explicabo dignissimos debitis vel! Adipisci eius voluptates, ad aut recusandae minus eaque facere.</p>
                       </div>
                   </div>
               </li>
               <li>
                   <div class="timeline-badge danger"><i class="fa fa-bomb"></i>
                   </div>
                   <div class="timeline-panel">
                       <div class="timeline-heading">
                           <h4 class="timeline-title">商品</h4>
                       </div>
                       <div class="timeline-body">
                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus numquam facilis enim eaque, tenetur nam id qui vel velit similique nihil iure molestias aliquam, voluptatem totam quaerat, magni commodi quisquam.</p>
                       </div>
                   </div>
               </li>
               <li class="timeline-inverted">
                   <div class="timeline-panel">
                       <div class="timeline-heading">
                           <h4 class="timeline-title">用户</h4>
                       </div>
                       <div class="timeline-body">
                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates est quaerat asperiores sapiente, eligendi, nihil. Itaque quos, alias sapiente rerum quas odit! Aperiam officiis quidem delectus libero, omnis ut debitis!</p>
                       </div>
                   </div>
               </li>
              
            </ul>
        </div>
    @show 
<!--后台页面继承模块 结束  -->
    
         </div>
    </div>      
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src='{{asset("/admins/bower_components/jquery/dist/jquery.min.js")}}'></script>

    <!-- Bootstrap Core JavaScript -->
    <script src='{{asset("/admins/bower_components/bootstrap/dist/js/bootstrap.min.js")}}'></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src='{{asset("/admins/bower_components/metisMenu/dist/metisMenu.min.js")}}'></script>
    <!-- Morris Charts JavaScript -->

    <!-- Custom Theme JavaScript -->
    <script src='{{asset("/admins/dist/js/sb-admin-2.js")}}'></script>
    <!-- 提示信息定时关闭 开始 -->
        <script>

            $(function(){
               setTimeout(function(){
                 $('.alert-info').hide();
                 $('.alert-danger').hide();
               },2000)
            })
        </script>
    <!-- 提示信息定时关闭 结束 -->

</body>

</html>

@section('js')

@show