@extends('layouts.admn')

@section('title','展示页面')

@section('content')
<h3>展示页面</h3>
    用户名：<input type="text" name="name"><input type="button" value='搜索' id='search'>
    <table class='table table-striped table-bordered'>
        <tr>
            <td>分类ID</td>
            <td>分类名</td>
            <td>操作</td>
        </tr>
        @foreach ($data as $v)
        <tr>
            <td>{{$v->sid}}</td>
            <td>{{$v->sname}}</td>
            <td>
                <a class='btn btn-danger'>删除</a>
                <a class='btn btn-success'>修改</a>
            </td>
        </tr>
        @endforeach
    </table>

 @endsection
 <!-- <td>&nbsp;</td> -->