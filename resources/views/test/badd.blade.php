@extends('layouts.admn')

@section('title','商品添加页面')

@section('content')
    <h3>商品添加页面</h3>
            <div class='form-group'>
                <label for="exampleInputEmail1">商品名称：</label>
                <input type="text" class='form-control' name='name'>
            </div>

            <div class='form-group'>
                <label for="exampleInputEmail1">商品价格：</label>
                <input type="text" class='form-control' name='money'>
            </div>
            <div class='form-group'>
                 <label for="exampleInputEmail1">商品图片：</label>
                 <input type="file" class='btn btn-default' name='photo'>
            </div>
             <!-- <button type='submit' class='btn btn-default' id='but'>提交</button> -->
            <input type="button" class='btn btn-default' id='but' value='提交'>
           <script>
                $('#but').on('click',function(){
                    alert('123');
                    
                })
             </script>
 @endsection