@extends('layouts.admn')

@section('title','商品添加页面')

@section('content')
	<h3>商品添加</h3>
	<ul class="nav nav-tabs">
	  <li role="presentation" class="active"><a href="javascript:;" name='basic'>基本信息</a></li>
	  <li role="presentation" ><a href="javascript:;" name='attr'>商品属性</a></li>
	  <li role="presentation" ><a href="javascript:;" name='detail'>商品详情</a></li>
	</ul>
	<br>
	<form action="{{url('goods/add_do')}}" method="POST" enctype="multipart/form-data" id='form'>
		
		<div class='div_basic div_form'>
			<div class="form-group">
				<label for="exampleInputEmail1">商品名称</label>
				<input type="text" class="form-control" name='goods_name'>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">商品分类</label>
				<select class="form-control" name='sid'>
					<option value='0'>请选择</option>
                    @foreach ($sortData as $v)
					    <option value='{{$v["sid"]}}'>{{$v['sname']}}</option>
                    @endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">商品货号</label>
				<input type="text" class="form-control" name='goods_price'>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">商品价钱</label>
				<input type="text" class="form-control" name='goods_price'>
			</div>

			<div class="form-group">
				<label for="exampleInputFile">商品图片</label>
				<input type="file" name='goods_img'>
			</div>
		</div>	
		<div class='div_detail div_form' style='display:none'>
			<div class="form-group">
				<label for="exampleInputFile">商品详情</label>
				<textarea class="form-control" rows="3" name='goods_desc'></textarea>
			</div>
		</div>
		<div class='div_attr div_form' style='display:none'>
			<div class="form-group">
				<label for="exampleInputEmail1">商品类型</label>
				<select class="form-control" name='tid' >
					<option>请选择</option>
                    @foreach ($typeData as $v)
					    <option value='{{$v["tid"]}}'>{{$v['tname']}}</option>
                    @endforeach
				</select>
			</div>	
			<br>

			<table width="100%" id="attrTable" class='table table-bordered'>
				<!-- <tr>
					<td>前置摄像头</td>
					<td>
						<input type="hidden" name="attr_id_list[]" value="211">
						<input name="attr_value_list[]" type="text" value="" size="20">  
						<input type="hidden" name="attr_price_list[]" value="0">
					</td>
				</tr>
				<tr>
					<td><a href="javascript:;">[+]</a>颜色</td>
					<td>
						<input type="hidden" name="attr_id_list[]" value="214">
						<input name="attr_value_list[]" type="text" value="" size="20"> 
						属性价格 <input type="text" name="attr_price_list[]" value="" size="5" maxlength="10">
					</td>
				</tr> -->
			</table>
			<!-- <div class="form-group">
					颜色:
					<input type="text" name='attr_value_list[]'>
			</div> -->
			<!-- <div class="form-group" style='padding-left:26px'>
				<a href="javascript:;">[+]</a>内存:
				<input type="text" name='attr_value_list[]'>
				属性价格:<input type="text" name='attr_price_list[][]'>
			</div> -->
			
		</div>

	  <button type="submit" class="btn btn-default" id='btn'>添加</button>
	</form>

	<script type="text/javascript">
		//标签页 页面渲染
		$(".nav-tabs a").on("click",function(){
			$(this).parent().siblings('li').removeClass('active');
			$(this).parent().addClass('active');
			var name = $(this).attr('name');  // attr basic
			$(".div_form").hide();
			$(".div_"+name).show();  // $(".div_"+name)
		})

            //根据类型 查询出该类型下对应的属性
            $("[name='tid']").on("change",function(){
                var tid = $(this).val();
                // alert(tid);
                $.ajax({
                    url:"{{url('goods/getAttr')}}",
                    data:{tid:tid},
                    dataType:"json",
                    success:function(res){
                        $("#attrTable").empty();
                        $.each(res,function(i,v){
                            if(v.is_show == 1 ){
                                //可选属性
                                var tr = '<tr><td><a href="javascript:;" class="addRow">[+]</a>'+v.aname+'</td><td><input type="hidden" name="attr_id_list[]" value="'+v.aid+'"><input name="attr_value_list[]" type="text" value="" size="20">属性价格 <input type="text" name="attr_price_list[]" value="0" size="5" maxlength="10"></td></tr>';
                            }else{
                                    var  tr = '<tr><td>'+v.aname+'</td><td><input type="hidden" name="attr_id_list[]" value="'+v.aid+'"><input name="attr_value_list[]" type="text" value="" size="20"><input type="hidden" name="attr_price_list[]" value="0"></td></tr>';
                            }
                            $("#attrTable").append(tr);
                        })
                    }
                })
            })

            //+ - 号效果
            $(document).on('click','.addRow',function(){
                // alert(1);
                var val = $(this).html();
                if(val == "[+]"){
                     //选择谁 操作谁
                    $(this).html("[-]");//复制需要-号
                    var tr_clone = $(this).parent().parent().clone();
                    $(this).html("[+]");
                    $(this).parent().parent().after(tr_clone);
                }else{
                    $(this).parent().parent().remove();
                }
               
            })


	</script>
@endsection