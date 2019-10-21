@extends('layouts.admn')

@section('title','分类页面')

@section('content')
    <h3>分类页面</h3>
    <form action="{{url('sort/sadd_do')}}" method='post'>
            <div class='form-group'>
                <label for="exampleInputEmail1">分类名称：</label>
                <input type="text" class='form-control' name='sname'>
            </div>
            <input type="submit" value='提交'  class='btn btn-default' >

    </form>
            
 @endsection