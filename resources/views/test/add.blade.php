@extends('layouts.admn')

@section('title','添加页面')

@section('content')
    <h3>添加页面</h3>
            <div class='form-group'>
                <label for="exampleInputEmail1">用户名：</label>
                <input type="text" class='form-control' name='name'>
            </div>

            <div class='form-group'>
                <label for="exampleInputEmail1">年龄：</label>
                <input type="text" class='form-control' name='age'>
            </div>
            <div class='form-group'>
                 <label for="exampleInputEmail1">上传图片：</label>
                 <input type="file" class='btn btn-default' name='photo'>
            </div>
             <button type='submit' class='btn btn-default' id='bind'>提交</button>

             <script>
                $('#bind').on('click',function(){
                    // alert('123');
                    var url = 'http://wzc.com/api/post';
                    var name = $("[name='name']").val();
                    var age = $("[name='age']").val();
                    // alert(name);
                    // alert(age);

                    var fd = new FormData();
                    fd.append('photo',$("[name='photo']")[0].files[0]);
                    fd.append('name',name);
                    fd.append('age',age);
                    $.ajax({
                        url:url,
                        type:'POST',
                        data:fd,
                        contentType:false,   //post数据类型  unlencode
			            processData:false,   //处理数据
                        dataType:"json",
                        success:function(res){
                            if(res.ret == 1){
                                alert(res.msg);
                                location.href = "http://www.wzc.com/test/show";
                            }else{
                                alert('res.msg');
                            }
                        }

                    })
                })
             </script>
 @endsection