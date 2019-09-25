@extends('layouts.shop')
@section('content')
<div class="head-top">
      <img src="/index/images/a.jpg" />
      <dl>
       <dt><a href="{{route('user')}}"><img src="/index/images/b.jpg" /></a></dt>
       <dd>
{{--        @if (session('indexinfo'!='')) {{session('indexinfo')['u_email']}} @else <a href="/index/login">请先登录</a> @endif--}}
        <h1 class="username">xc</h1>
        <ul>
         <li><a href="prolist.html"><strong>{{$count}}</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
      <li><a href="{{url('index/login')}}">登录</a></li>
      <li><a href="{{route('reg')}}" class="rlbg">注册</a></li>
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     <div id="sliderA" class="slider">
      <img src="/index/images/c.jpg" />
      <img src="/index/images/d.jpg" />
      <img src="/index/images/e.jpg" />
      <img src="/index/images/f.jpg" />
      <img src="/index/images/g.jpg" />
     </div><!--sliderA/-->
     <ul class="pronav">
      @foreach($cate as $v)
        <li><a href="{{url('/index/prolist/'.$v->c_id)}}">{{$v->c_name}}</a></li>
      @endforeach
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
         @foreach($goods as $g)
      <div class="index-pro1-list">
       <dl>
        <dt><a href="{{url('/index/proinfo/'.$g->goods_id)}}"><img src="{{env('UOLOAD_URL')}}./{{$g->goods_img}}" /></a></dt>
        <dd class="ip-text"><a href="{{url('/index/proinfo/'.$g->goods_id)}}">{{$g->goods_name}}</a><span>已售：488</span></dd>
        <dd class="ip-price"><strong>¥{{$g->goods_price}}</strong> <span>¥{{$g->goods_price*1.3}}</span></dd>
       </dl>
      </div>
         @endforeach
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
    @foreach($goods as $g)
     <div class="prolist">
      <dl>
       <dt><a href="{{url('/index/proinfo/'.$g->goods_id)}}"><img src="{{env('UOLOAD_URL')}}/{{$g->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{url('/index/proinfo/'.$g->goods_id)}}">{{$g->goods_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$g->goods_price}}</strong> <span>¥{{$g->goods_price*1.3}}</span></div>
        <div class="prolist-yishou"><span>7.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--prolist/-->
    @endforeach
<div class="joins"><a href="fenxiao.html"><img src="/index/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="index.html">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="prolist.html">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="car.html">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl>
       <a href="user.html">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
     @endsection