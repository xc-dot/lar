@extends('layouts.admn')

@section('title','修改页面')

@section('content')
    <h3>修改页面</h3>
            <div class='form-group'>
                <label for="exampleInputEmail1">用户名：</label>
                <input type="text" class='form-control' name='name' >
            </div>

            <div class='form-group'>
                <label for="exampleInputEmail1">性别：</label>
                <input type="text" class='form-control' name='age' >
            </div>
             <button type='submit' class='btn btn-default' id='but'>修改</button>

             <script>
             
                function getUrlParms(name){
                            var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                            var r = window.location.search.substr(1).match(reg);
                            if(r!=null)
                            return unescape(r[2]);
                            return null;
                        }
                        var url ='http://www.wzc.com/api/post';
                        var id = getUrlParms("id");   
                                        
                        $.ajax({
                        url:url+'/'+id,
                        type:"GET",
                        dataType:'json',
                        // data:{id:id},
                        success:function (res) {
                            //替换默认值
                                var name=$('[name="name"]').val(res.data.name);
                                var name=$('[name="age"]').val(res.data.age);
                        }
                    })
                $('#but').on('click',function(){
                    // alert('123');
                    var name = $('[name="name"]').val();
                    var age = $('[name="age"]').val();
                    $.ajax({
                        url:url+"/"+id,
                        type:"POST",
                        data:{name:name,age:age,id:id,"_method":"PUT"},
                        dataType:"json",
                        success:function(res){
                            if(res.ret==1){
                            alert(res.msg);
                            location.href="http://www.wzc.com/test/show";
                        }
                        }

                    })
                })
             </script>
 @endsection