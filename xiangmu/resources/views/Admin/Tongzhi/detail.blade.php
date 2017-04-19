@extends('Admin.User.parent')
@section('title','消息详情')

@section('content')
    
<center>
    <h1>消息详情</h1>
    <table style="table-layout: fixed;width:500px;" class="table table-bordered">
        <tr>
            <td>发送者：</td>
            <td>{{$data->f_name}}</td>
        </tr>
        <tr>
            <td>接收者：</td>
            <td>{{$data->s_name}}</td>
        </tr>
        <tr>
            <td>发送内容：</td>
            <td>{{$data->content}}</td>
        </tr>
        <tr>
            <td>发送时间：</td>
            <td>{{date('Y-m-d h:i:s',$data->regdate)}}</td>
        </tr>
        <tr>
            <td>
                <button type="button" class="btn btn-success reply">回复</button>
            </td>
        </tr>
    </table>
    <form action="/Admin/Tongzhi/reply" method="post" style="display:none" class="biao">
        <textarea rows="3" style="width:500px" name="content" class="con"></textarea><br/>
        {{ csrf_field() }}
        <input type="hidden" name="s_id" value="{{$data->f_id}}">
        <input type="hidden" name="s_name" value="{{$data->f_name}}">
        <button type="submit" class="btn btn-success submit">回复</button>
    </form>
    <div style="height:300px"></div>
</center>
@endsection
@section('js')
<script>
    $(function(){
        $('.reply').click(function(){
            $(this).css('display','none');
            $('.biao').css('display','block');
        })
        $('.submit').click(function()
        {
            // 获取留言内容
                var con=$('.con').val();
                if(!con)
                {
                    $('.biao').css('display','none');
                    $('.reply').show();
                    return false;
                }
        })
    }) 
    
</script>   

@endsection