@extends('layouts.admn')

@section('title','绑定账号')

@section('content')
    <h3>绑定管理员账号</h3>
        <form action="{{url('hadmin/bind_do')}}" method='post'>
            @csrf
            <div class='form-group'>
                <label for="exampleInputEmail1">用户名：</label>
                <input type="text" class='form-control' name='username'>
            </div>

            <div class='form-group'>
                <label for="exampleInputEmail1">密码：</label>
                <input type="password" class='form-control' name='password'>
            </div>
             <button type='submit' class='btn btn-default' id='bind'>绑定</button>
        </form>
 @endsection