@extends('Home.index')
@section('content')
    
 <div class="panel-body">
        <div class="row">
            <div class="row">
                <div class="col-xs-6 col-md-6">
                    <form role="form" action="/Home/User/paimaipicupdate" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <img src="/sale/{{$data->pic}}" width="200px">    
                       
                            <input type="file" id="exampleInputFile" name="pic">
                            <input type="hidden" name="old_pic" value="{{$data->pic}}">
                        </div>
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <br>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-default">修改图片</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection    