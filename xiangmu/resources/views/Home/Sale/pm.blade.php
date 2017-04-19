
@extends('Home.index')
@section('content')

<ol class="breadcrumb">
    <li style="font-size:30px">拍卖</li>
    <li>{{$pname}}</li>
    <li>{{$names}}</li>
</ol>

  
  <link rel="stylesheet" href="/homes/css/paimai.css" />
  <script type="text/javascript" async="" src="/homes/js/index.js"></script>
  <script src="/homes/js/index(1).js"></script>
  <script src="/homes/js/index(2).js"></script> 
 
<!-- 标题一 -->
   <div class="ocms-layout-1688-wap-layout-common-1-0-4" data-nojs="true" id="1" style="background-image:;background-position:0% 0%;background-repeat:repeat;background-color:rgb(245, 245, 245);margin-bottom:;height:40px;" originid="0vz4vt5z" component-schema="{&quot;type&quot;:&quot;jdata&quot;,&quot;id&quot;:&quot;&quot;}" component-type="layout" component-version="1.0.4" component-name="@alife/ocms-layout-1688-wap-layout-common" data-spm="izjh1lm0" component-id="2" component-stage="render">
      <div> 
       <div class="croco slot" name="main">
        <div class="ocms-component-1688-pc-common-banner-1-0-11" data-nojs="true" originid="3t6linou" >
         <div class="common-banner-20161017" style=""> 
            <div class="content"> 
               <div style="background-color: orange; width:1200px; height:40px; float:left;">
                   <p style="line-height:40px;text-align:center;font-size:16px; ">拍卖列表</p>
               </div>
               
           </div> 
         </div>
        </div>
       </div> 
      </div> 
   </div>

<!-- 整个div -->
   <div class="ocms-layout-1688-pc-layout-tl-1-0-5" originid="ng1wwwhp" component-schema="{&quot;type&quot;:&quot;jdata&quot;,&quot;id&quot;:&quot;349&quot;}" component-type="layout" component-version="1.0.5" component-name="@alife/ocms-layout-1688-pc-layout-tl" data-spm="izjh1p87" component-id="212" component-stage="afterRender"> 
    <div class="layout-tl" style=""> 
     <style type="text/css"></style> 
     <div class="croco slot" name="layout">
      <div class="ocms-component-1688-pc-dx-pc-offers-1-0-37" >
       <div class="wsd-dx-offers" style="background:#f5f5f5;"> 
        <div class="wsd-w1200" style="margin-top:10px;"> 
         <div class="wsd-list"> 
        

<!-- 一个商品 开始-->
  @foreach($sales as $k=>$v)
            <div class="wsd-item wsd-item5 parent" data-offer-id="541286285619"> 
              <!-- 跳到详情页面 -->
              <a href='/Home/Auction/xq?id={{$v->id}}' id="prg" class="tiaozhuan"> 
                  <div class="wsd-img pic-box"> 
                    <img class="pic" src="/sale/{{$a[$k]->pic}}"/> 
                    <div style="display:none" class="ltime">
                      {{$v->ltime}}
                    </div>
                    <div style="display:none" class="id">
                      {{$v->id}}
                    </div> 

                    <div class="wsd-h"> 
                    <div class="wsd-hbg"></div> 
                      <i></i> 
                      <span class="wsd-ck">
                        <div class="time" style="color:white; font-size:20px;" id="ww">
                        <p class="daojishi">拍卖倒计时</p>
                          <span class="t_d">00天</span>
                          <span class="t_h">00时</span>
                          <span class="t_m">00分</span>
                          <span class="t_s">00秒</span>
                        </div>
                      </span> 
                    </div> 
                  </div> 
                  <div class="wsd-txt "> 
                    <div class="wsd-p"> 
                      <div class="wsd-pinner"> 
                        <input type="hidden"  value="{{$v->id}}" name="id"> 
                           <div class="wsd-p1 wsd-ellip">
                            {{$v->title}}
                           </div> 
                            <div class="wsd-p3"></div> 
                            <div class="wsd-p4"> 
                                 <dt >
                                    结束时间 
                                    <p>{{$v->ltime}}</p>
                                 </dt> 
                            </div> 
                      </div> 
                    </div> 
                     <div class="wsd-p6"> 
                     </div> 
                  </div> 
                  <div class="wsd-btn"> 
                      <span class="btn-to-tb distribute-to-taobao wsd-ctb" data-offer-id="541286285619" href="javascript:;"> <span class="wsd-bg"></span> <span class="wsd-price"><span class="wsd-rmb">最低价：</span>{{$v->dprice}}</span> <span class="wsd-tb con" id="cc">立即拍买</span> </span> 
                  </div>
              </a> 
            </div> 
  @endforeach
<!-- 一个商品 结束 -->
         </div> 
        </div> 
       </div>
      </div>
     </div> 
    </div> 
   </div>
<script> 
  $('.wsd-hbg').hover(function(){
      var ltime = $(this).parents('.parent').find('.ltime').html();
      //2017-03-31 15:56:41 
      var reg = /-/g;
      var lres = ltime.replace(reg,'/');
      s = 0;
      m = 0;
      h = 0;
      d = 0;
      var data=$(this);
      var GetRTime = setInterval(function(){
           
           var EndTime = new Date(lres);
           var NowTime = new Date();
           var t=EndTime.getTime()-NowTime.getTime();
           if(t<=0)
           {
              clearInterval(GetRTime);
              data.parents('.parent').find('.daojishi').html('拍卖已结束');
              data.parents('.parent').find('.tiaozhuan').attr('href','javascript:return false;');
           }else
           {
               var d=Math.floor(t/1000/60/60/24);
               var h=Math.floor(t/1000/60/60%24);
               var m=Math.floor(t/1000/60%60);
               var s=Math.floor(t/1000%60);
              
               data.parents('.parent').find('.t_d').html(d + "天");
               data.parents('.parent').find('.t_h').html(h + "时");
               data.parents('.parent').find('.t_m').html(m + "分");
               data.parents('.parent').find('.t_s').html(s + "秒");
           }
          

       },0);
  });   
</script>




@endsection