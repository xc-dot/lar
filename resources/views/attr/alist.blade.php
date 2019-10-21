@extends('layouts.admn')

@section('title','属性展示页面')

@section('content')
<h3>属性展示页面</h3>
    类型名：<input type="text" name="aname"><input type="button" value='搜索' id='search'>
    <table class='table table-striped table-bordered'>
        <tr>
            <td><input type="checkbox" class='i-checks' id='all'>全选</td>
            <td>属性型ID</td>
            <td>属性名</td>
            <td>商品类型</td>
            <td>属性是否可选</td>
            <!-- <td>操作</td> -->
        </tr>
        @foreach ($data as $v)
        <tr>
            <td><input type="checkbox" class='i-checks' aid='{{$v->aid}}' name='interest'>{{$v->aid}}</td>
            <td>{{$v->aid}}</td>
            <td>{{$v->aname}}</td>
            <td>{{$v->tname}}</td>
            <td>
                @if($v->is_show==1)
                    规格(可选)
                @else
                    参数(不可选)
                @endif
            </td>
            <!-- <td>
                <a class='btn btn-danger'>删除</a>
                <a class='btn btn-success'>修改</a>
            </td> -->
        </tr>
        @endforeach
    </table>

    <input type="button" value="删除" id="del">

    <script>
        $(function () {
            // alert(111);
            $('#all').click(function() {
                    // console.log($(this).prop('checked'));
                    var bAll = $(this).prop('checked');
                    if (bAll) {
                    //全选
                    $('tbody tr').addClass('selected');
                    $('tbody :checkbox').prop('checked', true);
                } else {
                    //全不选
                    $('tbody tr').removeClass('selected');
                    $('tbody :checkbox').prop('checked', false);
                }
            })
            $('#del').click(function () {
                    //alert(111);
                    //定义一个数组
                    var attr_id =[];
                    //遍历每一个名字为interest的复选框，其中选中的执行函数
                    $('input[name="interest"]:checked').each(function(){
                        //将选中的值添加到数组chk_value中
                        attr_id.push($(this).attr('aid'));
                    });
            })
        })
    </script>
 @endsection
 <!-- <td>&nbsp;</td> -->