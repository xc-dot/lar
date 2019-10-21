@extends('layouts.admn')

@section('title','类型展示页面')

@section('content')
<h3>类型展示页面</h3>
    类型名：<input type="text" name="name"><input type="button" value='搜索' id='search'>
    <table class='table table-striped table-bordered'>
        <tr>
            <td>类型ID</td>
            <td>类型名</td>
            <td>属性数</td>
            <td>操作</td>
        </tr>
        @foreach ($data as $v)
        <tr>
            <td>{{$v->tid}}</td>
            <td>{{$v->tname}}</td>
            <td>{{$v->attr_count}}</td>
        
            <td>
                <a href="{{url('attr/alist')}}?tid={{$v->tid}}" class='btn btn-danger'>属性列表</a>
                <!-- <a class='btn btn-success'>修改</a> -->
            </td>
        </tr>
        @endforeach
    </table>

 @endsection
 <!-- <td>&nbsp;</td> -->