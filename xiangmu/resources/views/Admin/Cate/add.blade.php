@extends('Admin.User.parent')
@section('title','商品添加')


@section('content')
    <div class="panel-body">
        <div class="row">

            <div class="col-lg-6 col-lg-offset-3">

                <form role="form" method="post" action="/Admin/Cate/add">
                    <div class="form-group">
                        <label class="control-label">商品类名:</label>
                        <select name="pid" class="form-control">
                            <option value="0">添加类</option>
                            @foreach($res as $v)
                                @if($v->pid=='0')
                                    <option value="{{$v->id}}">{{$v->name}}</option>
                                @endif
                            @endforeach
                        </select>

                    </div>

                    <div class="form-group">
                        {{ csrf_field() }}
                        <input class="form-control" name="name" type="text" value="">
                    </div>

                    <button type="submit" class="btn btn-default">添加</button>

                </form>
            </div>

            <!-- /.col-lg-6 (nested) -->
        </div>
        <!-- /.row (nested) -->
    </div>



@endsection