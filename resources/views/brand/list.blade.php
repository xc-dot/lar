@extends('layouts.admn')

@section('title','展示页面')

@section('content')
<h3>展示页面</h3>
    用户名：<input type="text" name="name"><input type="button" value='搜索' id='search'>
    <table class='table table-striped table-bordered'>
        <tr>
            <td>商品ID</td>
            <td>商品名</td>
            <td>商品价格</td>
            <td>操作</td>
        </tr>
        <tbody id='list'>
        </tbody>
    </table>
    <nav aria-label="Page navigation">
         <ul class="pagination"></ul>
    </nav>
<script>
    $.ajax({
        url:"http://www.wzc.com/brand/blist",
        dataType:'json', 
        success:function(res){
            showData(res);
        }  
    })
    //分布功能 所有JS动态渲染的节点document绑定
    $(document).on('click',".pagination a",function(){
        // alert(1);
            //获取搜索内容
        var name = $("[name='name']").val();
        var page =$(this).text();
        $.ajax({      
                url:"http://www.wzc.com/brand/blist",
                dataType:'json',
                data:{page:page,name:name},
                success:function(res) {

                    showData(res);
                }
            })
    })     
    /**
        *根据后台数据  渲染表格数据 
        */
    function showData(res)
    {
        $("#list").empty();
            $.each(res.data.data,function(k,v){
                var tr = $('<tr></tr>');
                tr.append("<td>"+v.id+"</td>");
                tr.append("<td>"+v.name+"</td>");
                tr.append("<td>"+v.money+"</td>");
                tr.append("<td><a class='btn btn-danger' id="+v.id+">删除</a>&nbsp;<a href='' class='btn btn-success'>修改</a></td>");
                $("#list").append(tr);
             })    
            $('.btn-danger').click(function() {
                var id = $(this).attr('id');
                // alert(id);
                $.ajax({      
                    url:"http://www.wzc.com/brand/delete",
                    dataType:'json',
                    data:{id:id},
                    success:function(res) {
                        if (res.res == 1) {
                            alert(res.msg);
                            location.href = "http://www.wzc.com/brand/list"
                        }
                    }
                })
            })  
            //页面分页页码渲染
            var max_page = res.data.last_page; 
            $(".pagination").empty();
            for(var i= 1; i <= max_page; i++){
                var li ="<li><a href='javascript:;'>"+i+"</a></li>";
                $(".pagination").append(li);
            }
    }


    // //搜索
    $("#search").on('click',function(){
        var name = $("[name='name']").val();
        //发送请求
        $.ajax({
            url:"http://www.wzc.com/brand/blist",
            dataType:'json', 
            type:'GET',
            data:{name:name},
            success:function(res){
                showData(res);
            }  
        })
    })
</script>
 @endsection