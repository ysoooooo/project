<!-- 模版继承  -->
@extends('Admin.User.parent')
<!-- 标题 -->
@section('title','广告添加')
<!-- 头 -->
@section('header','广告添加')
<!-- 添加内容 -->
@section('content')

<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                           <!--  @if(count($errors) > 0)
	                            <div class="alert alert-danger">
	                            	<ul>
	                            		@foreach ($errors->all() as $error)
	                            			<li>{{ $error }}</li>
	                            		@endforeach
	                            	</ul>
	                            </div>
                            @endif -->
                                <div class="col-lg-6 col-lg-offset-3">
                                     <form role="form" method="post" action="{{url('/Admin/Ad/insert')}}" 
                                     enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>主题</label>
                                            <input placeholder="请输入主题" type="text" name="title" 
                                            value="{{old('title')}}" class="form-control">  
                                        </div>
                                        <div class="form-group">
                                            <label>介绍</label>
                                            <input placeholder="输入介绍" type="text" name="explain" value="{{old('explain')}}" class="form-control">
                                        </div>
                                         <div class="form-group">
                                            <label>链接</label>
                                            <input placeholder="输入链接" type="text" name="link" value="{{old('link')}}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>图片上传</label>
                                            <input type="file" value="{{old('pic')}}" name="pic">
                                        </div>
                                        {{ csrf_field() }}
                                        <button class="btn btn-default">提交</button>
                                        <button class="btn btn-default" type="reset">重置</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
@endsection                