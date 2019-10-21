@extends('layouts.admn')

@section('title','货品添加页面')

@section('content')
<h3>货品添加</h3>
<form action="{{url('goods/productAdd_do')}}" method="post">
<table width="100%" id="table_list" class='table table-bordered'>
<input type="hidden" name='goods_id' value="{{$goods_id}}">
    <tbody>
    <tr>
      <th colspan="20" scope="col">商品名称：oppo11&nbsp;&nbsp;&nbsp;&nbsp;货号：ECS000075</th>
    </tr>

    <tr>
      <!-- start for specifications -->
      @foreach($attrData as $key=>$value)
      <td scope="col"><div align="center"><strong>{{$key}}</strong></div></td>
      @endforeach
      <!-- <td scope="col"><div align="center"><strong>颜色</strong></div></td> -->
            <!-- end for specifications -->
      <td class="label_2">货号</td>
      <td class="label_2">库存</td>
      <td class="label_2">&nbsp;</td>
    </tr>
    
    <tr id="attr_row">
	    <!-- start for specifications_value -->
      @foreach($attrData as $key=>$value)
		<td align="center" style="background-color: rgb(255, 255, 255);">
			<select name="goods_attr[]">
				<option value="" selected="">请选择...</option>
      @foreach($value as $k=>$v)
				<option value="{{$v['id']}}">{{$v['attr_value']}}</option>
        @endforeach
			</select>
		</td>
    @endforeach
		<!-- <td align="center" style="background-color: rgb(255, 255, 255);">
			<select name="attr[214][]">
				<option value="" selected="">请选择...</option>
			    <option value="土豪金">土豪金</option>
			    <option value="太空灰">太空灰</option>
			</select>
		</td> -->
	    <!-- end for specifications_value -->
		<td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_sn[]" value="" size="20"></td>
		<td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_number[]" value="1" size="10"></td>
		<td style="background-color: rgb(255, 255, 255);"><input type="button" class="button addRow" value=" + " ></td>
    </tr>

    <tr>
      <td align="center" colspan="5" style="background-color: rgb(255, 255, 255);">
        <input type="submit" class="button" value=" 保存 ">
      </td>
    </tr>
  </tbody>
</table>
</form>

<script>
  //+ - 号效果
  $(document).on('click','.addRow',function(){
                // alert(1);
                var val = $(this).val();
                if(val == " + "){
                     //先把当前行 复制一行
                    $(this).val(" - ");
                    var tr = $(this).parent().parent();
                    var tr_clone = tr.clone();
                    $(this).val(" + ");
                    tr.after(tr_clone);
                }else{
                    $(this).parent().parent().remove();
                }
               
            })

</script>
@endsection