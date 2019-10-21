@extends('layouts.admn')

@section('title','属性添加页面')

@section('content')
    <h3>属性页面</h3>
    <form action="{{url('attr/add_in')}}" method='post'>
            <div class='form-group'>
                <label for="exampleInputEmail1">属性名称：</label>
                <input type="text" class='form-control' name='aname'>
            </div>
            <div class='form-group'>
                 <label for="exampleInputEmail1">所属商品类型：</label>
               <!-- <input type="text" class='form-control' name='tnum'> -->
              
                <select name="tid" id="" class='form-control'>
                    <option value="0">请选择...</option>
                    @foreach ($asser as $v)
                    <option value="{{$v->tid}}">{{$v->tname}}</option>
                    @endforeach
                </select>
            </div>
            <div class='form-group'>
                 <label for="exampleInputEmail1">属性是否可选：</label>
               <input type="radio" name='is_show' value='1'>规格(可选)
               <input type="radio" name='is_show' value='2'>参数(不可选)
            </div>
            <input type="submit" value='提交'  class='btn btn-default' >
    </form>
 @endsection