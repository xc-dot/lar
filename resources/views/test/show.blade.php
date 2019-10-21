@extends('layouts.admn')

@section('title','展示页面')

@section('content')
    <h3>展示页面</h3>
    用户名：<input type="text" name="name"><input type="button" value='搜索' id='search'>
           <table class='table table-striped table-bordered'>
                <tr>
                    <td>用户ID</td>
                    <td>用户名</td>
                    <td>年龄</td>
                    <td>操作</td>
                </tr>
                <tbody id='list'>
                
                </tbody>
               
           </table>

           <nav aria-label="Page navigation">
            <ul class="pagination">
                <!-- <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a> -->
                <!-- </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li> -->
                <!-- <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li> -->
            </ul>
            </nav>

            <script>
              var url ='http://www.wzc.com/api/post';
                $.ajax({
                    url:url,
                    dataType:'json', 
                    type:'GET',
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
                            url:url,
                            type:'GET',
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
                                    tr.append("<td>"+v.age+"</td>");
                                    tr.append("<td><a class='btn btn-danger' id="+v.id+">删除</a>&nbsp;<a href='http://www.wzc.com/test/upd?id="+v.id+"' class='btn btn-success'>修改</a></td>");
                                    $("#list").append(tr);
                                })    
                        $('.btn-danger').click(function() {
                                    var id = $(this).attr('id');
                                    // alert(id);
                                    $.ajax({      
                                        url:url+'/'+id,
                                        type:'delete',
                                        dataType:'json',
                                        data:{id:id},
                                        success:function(res) {
                                            if (res.res == 1) {
                                                alert(res.msg);
                                                location.href = "http://www.wzc.com/test/show"
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


                //搜索
                $("#search").on('click',function(){
                    var name = $("[name='name']").val();
                    //发送请求
                    $.ajax({
                        url:url,
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