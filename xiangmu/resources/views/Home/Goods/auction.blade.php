@extends('Home.index')
@section('content')
<style>
        * { margin: 0; padding: 0; }

        #bg { position: absolute; top: 1; left: 0; }
        .bgwidth { width: 100%; }
        .bgheight { height: 100%; }
        .row { 
            width: 800px;
            margin: 15px auto;
            padding: 20px;
            background: ;
            opacity: 0.8;
            box-shadow: 0 0 20px black;
        }
        .row1 { 
            width: 500px;
            margin: 35px auto;
            padding: 15px;
            padding-left: 200px;
            background: ;
            opacity: 0.8;
            box-shadow: 0 0 20px black;
        }
        .footer-bottom{ position: absolute; top: 1; left: 0;width: 100%; }
    </style>

<img src="/homes/images/2 (2).jpg" id="bg">
<div class="row1 col-lg-12 col-lg-offset-3">
    <h1>&nbsp;&nbsp;&nbsp;发布拍卖</h1>
</div>
<div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                     <form role="form" method="post" action="/Home/Auction/insert" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>主题</label>
                            <input placeholder="输入主题" type="text" name="title" value="{{old('title')}}" class="form-control">  
                        </div>
                        <div class="form-group">
                            <label>分类</label>
                                <span class="select-box ">
                                  <select class="select" name="p_id">
                                         @foreach($cate as $k=>$v)
                                           <option value="{{$v->id}}">{{$v->name}}</option>
                                         @endforeach
                                  </select>
                                </span> 
                        </div>
                        <div class="form-group">
                            <label>底价</label>
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
<script>
    $(window).load(function() {
        var theWindow = $(window);
        var $bg = $('#bg');
        var aspectRatio = $bg.width() / $bg.height();

        function resizeBg() {
            if(theWindow.width() / theWindow.height() < aspectRatio) {
                $bg
                    .removeClass()
                    .addClass('bgheight');
            } else {
                $bg
                    .removeClass()
                    .addClass('bgwidth');
            }
        }

        theWindow.resize(resizeBg).trigger('resize');
    });
</script>

@endsection
