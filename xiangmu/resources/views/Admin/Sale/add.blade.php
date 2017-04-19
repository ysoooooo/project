@extends('Admin.User.parent')
@section('title','添加')
@section('content')


<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-3">
                                     <form role="form" method="post" action="{{url('/Admin/Sale/insert')}}" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>主题</label>
                                            <input placeholder="输入主题" type="text" name="title" value="{{old('title')}}" class="form-control">  
                                        </div>
                                        <div class="form-group">
                                            <label>分类</label>
                                                <span class="select-box ">
                                                  <select class="select" name="p_id">
                                                         @foreach($cates as $k=>$v)
                                                           <option value="{{$v->id}}">{{$v->name}}</option>
                                                         @endforeach
                                                  </select>
                                                </span> 
                                        </div>
                                        <div class="form-group">
                                            <label>价格</label>
                                            <input placeholder="请输入价格" type="txt" name="dprice" value="{{old('dprice')}}" class="form-control">
                                        </div>
                                       <div class="form-group">
                                            <label>拍卖时间</label>
                                            <!-- <input placeholder="输入拍卖时间" type="text" name="stime" value="{{old('stime')}}" class="form-control"> -->
                             
                <input placeholder="输入拍卖时间" type="text" value="{{old('stime')}}" class="form-control" onfocus="WdatePicker({ dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{$dp.$D(\'commentdatemax\')||\'%y-%M-%d\'}' })" id="commentdatemin" name="stime" >
                   
                                        </div>
                                        <div class="form-group">
                                            <label>结束时间</label>
                                            <!-- <input placeholder="输入结束时间" type="text" name="ltime" value="{{old('ltime')}}" class="form-control"> -->
                  <input placeholder="输入结束时间" type="text" value="{{old('ltime')}}" onfocus="WdatePicker({ dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'commentdatemin\')}' })" id="commentdatemax" name="ltime" class="form-control">                      
                                        </div>
                                        <div class="form-group">
                                            <label>介绍</label>
                                            <input placeholder="输入介绍" type="text" name="keyword" value="{{old('keyword')}}" class="form-control">
                                            <input type="hidden" name="uid" value="{{session('hid')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>图片上传</label>
                                            <input type="file"  id="exampleInputFile" multiple name="pic[]">
                                        </div>
                                        {{ csrf_field() }}
                                        <button class="btn btn-default">发布拍卖</button>
                                        
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