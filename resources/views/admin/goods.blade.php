<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>话题添加-有点</title>
    <link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                        href="#">商品管理</a>&nbsp;-</span>&nbsp;商品添加
        </div>
    </div>
    <div class="page ">
        <!-- 上传广告页面样式 -->
        <div class="banneradd bor">
            <div class="baTopNo">
                <span>商品添加</span>
            </div>
            <form action="{{route ('goods_do')}}" method="post" enctype="multipart/form-data">
                <div class="baBody">
                    <div class="bbD">
                        商品名称：<input type="text" name="goods_name" class="input3" />@php echo($errors->first('goods_name')) ;@endphp
                    </div>
                    <div class="bbD">
                        商品数量：<input type="text" name="goods_number" class="input3" />@php echo($errors->first('goods_number')) ;@endphp
                    </div>
                    <div class="bbD">
                        商品价格：<input type="text" name="goods_price" class="input3" />@php echo($errors->first('shop_price')) ;@endphp
                    </div>
                    <div class="bbD">
                        商品图片：<input type="file" name="goods_img" />
                    </div>
                    <div class="bbD">
                        商品品牌：<select class="input3" name="brand_id">
                            <option></option>
                            @foreach($res as $c)
                                <option value="{{$c->brand_id}}">{{$c->brand_name}}</option>
                            @endforeach
                        </select> @php echo($errors->first('brand_id')) ;@endphp
                    </div>
                    <div class="bbD">
                        商品分类：<select class="input3" name="c_id">
                            <option></option>
                            @foreach ($admin_cat as $v)
                                <option value="{{$v->c_id}}">{{str_repeat('__',$v->level).$v->c_name}}</option>
                            @endforeach

                        </select>@php echo($errors->first('c_id')) ;@endphp
                    </div>
                    <div class="bbD">
                        是否热卖：<label><input type="radio" checked="checked"
                                           name="is_hot" value="0" />&nbsp;是</label><label><input type="radio"
                                                                                                  name="is_hot" value="0" />&nbsp;否</label>
                    </div>
                    <div class="bbD">
                        是否新品：<label><input type="radio" checked="checked"
                                           name="is_new" value="0"/>&nbsp;是</label><label><input type="radio"
                                                                                                 name="is_new" value="1"/>&nbsp;否</label>
                    </div>
                    <div class="bbD">
                        是否上架：<label><input type="radio" checked="checked"
                                           name="is_on_sale" value="0"/>&nbsp;是</label><label><input type="radio"
                                                                                                     name="is_on_sale" value="1"/>&nbsp;否</label>
                    </div>
                    <div class="bbD">
                        <p class="bbDP">
                            <input type="submit" class="btn_ok btn_yes" value="提交"/>
                        </p>
                    </div>
                </div>
        </div>
        </form>
        <!-- 上传广告页面样式end -->
    </div>
</div>
</body>
</html>