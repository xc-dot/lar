@extends('layouts.admn')

@section('title','类型页面')

@section('content')
    <h3>类型页面</h3>
    <form action="{{url('type/add_to')}}" method='post'>
            <div class='form-group'>
                <label for="exampleInputEmail1">类型名称：</label>
                <input type="text" class='form-control' name='tname'>
            </div>
           
            <input type="submit" value='提交'  class='btn btn-default' >
    </form>
 @endsection