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
                 <input type="file" class='btn btn-default' name='img'>
            </div>
             <button type='submit' class='btn btn-default' id='but'>提交</button>
            <script>
                $('#but').on('click',function(){
                    // alert('123');
                    var name = $("[name='name']").val();
                    var money =$("[name='money']").val();
                    // alert(name);
                    // alert(money);
                    // var fd = new FormData();
                    // fd.append('img',$("[name='img']")[0].files[0]);
                    // fd.append('name',name);
                    // fd.append('money',money);
                    $.ajax({
                        url:'http://www.wzc.com/brand/add',
                        tyep:'POST',
                        data:{name:name,money:money},
                        // contentType:false,   //post数据类型  unlencode
			            // processData:false,   //处理数据
                        dataType:"json",
                        success:function(res){
                            if(res.ret == 1){
                                alert(res.msg);
                                location.href = "http://www.wzc.com/brand/list";
                            }else{
                                alert('res.msg');
                            }
                        }
                    })

                })
            </script>
 @endsection