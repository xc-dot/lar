<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="/index/images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/index/css/style.css" rel="stylesheet">
    <link href="/index/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <div class="dingdanlist">
      <table>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox"ot45 name="1" class="all" /> 全选</a></td>
       </tr>
          @foreach($data as $v)
       <tr>
        <td width="4%"><input type="checkbox" class="chk" name="1" value="{{$v->goods_id}}" /></td>
        <td class="dingimg" width="15%"><img src="{{env('UOLOAD_URL')}}/{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{date("Y-m-d H:i:s",$v->goods_time)}}</time>
        </td>
        <td align="right"><input type="text" class="spinnerExample"/></td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->price}}</strong></th>
       </tr>
          @endforeach
      </table>
     </div><!--dingdanlist/-->
     
     <div class="dingdanlist">
      <table>
       <tr>
        <td width="100%" colspan="4"><button class="del">删除</button></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">¥<b name="total">0.00</b></strong></td>
       <td width="40%"><a href="pay.html" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/index/js/bootstrap.min.js"></script>
    <script src="/index/js/style.js"></script>
    <!--jq加减-->
    <script src="/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	// 多选
	$('.all').click(function(){
        var all=$('.chk').prop('checked',$(this).prop('checked'));
        money(all)
    });
	// 反选
	$('.all:checked').click(function(){
	    var ass=$('.chk:checked').prop('checked',function(i,val){
            return !val;
        });
	    money();
    });
	// 计算价格
	function money(price){
        var id=new Array();
        $('.chk[type="checkbox"]:checked').each(function(res){
            id.push($(this).val());
        })
        $.post(
            "{{route('getmoney')}}",
            {id:id},
            function(res){
                $('[name="total"]').text(res.total);
            },
            'json'
        );
    }
    // 单选
    $('.chk').click(function(){
        var _this=$(this);
        money(_this);
    });
	// 删除
	$('.del').click(function(){
        var ids=new Array();
        var chk=$('.chk:checked');
        $.each(chk,function(){
            var id=$(this).val();
            ids.push(id);
        })
        // alert(ids)
        $.post(
            "{{route('index_del')}}",
            {ids:ids},
            function(res){
                alert(res.msg);
                if(res.code==1){
                    location.reload();
                }
            },
            'json'
        );
    })
	</script>
  </body>
</html>