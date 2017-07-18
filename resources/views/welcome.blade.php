<!DOCTYPE html>
<!-- saved from url=(0032)http://m.roadshowcenter.com/home -->
<html data-dpr="1" style="font-size: 25.75px;">
<head>
<title>金融牌照交易</title>
<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="format-detection" content="telephone=no, email=no">
<meta name="screen-orientation" content="portrait"><!-- uc强制竖屏 -->
<meta name="x5-orientation" content="portrait"><!-- QQ强制竖屏 -->

<script src="{{ asset('js/newRem.js') }}"></script>
<link rel="stylesheet" href="{{ elixir('css/index.css') }}">
<link rel="stylesheet" href="{{ elixir('css/app.css') }}">
</head>

<body>
<header class="topBar">
    金融牌照交易
</header>

<section class="swiper-container fixF swiper-container-horizontal swiper-container-android">
    <div class="swiper-wrapper">
        
        <div class="swiper-slide swiper-slide-active" style="width: 412px;">
            
            <a href="/">
            <img class="swiper-lazy swiper-lazy-loaded" src="./images/1_d81553ea7a486f85716b39400b2f659a.png">
            </a>
            
        </div>
        
        <div class="swiper-slide" style="width: 412px;">
            
            <a href="/">
            <img data-src="http://res.roadshowcenter.com/image/20170615/1_e00ff3781bcc44e69ad0470334cbcde4.png" class="swiper-lazy">
            </a>
            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </div>
        
        <div class="swiper-slide" style="width: 412px;">
            
            <a href="/">
            <img data-src="http://res.roadshowcenter.com/image/20170322/19_5355e628b78e23ca5155e7d56d660783.png" class="swiper-lazy">
            </a>
            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </div>
        
        <div class="swiper-slide" style="width: 412px;">
            
            <a href="/">
            <img data-src="http://res.roadshowcenter.com/image/20170615/1_e00ff3781bcc44e69ad0470334cbcde4.png" class="swiper-lazy">
            </a>
            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </div>
        
        <div class="swiper-slide" style="width: 412px;">
            
            <a href="/">
            <img data-src="http://res.roadshowcenter.com/image/20170322/19_5355e628b78e23ca5155e7d56d660783.png" class="swiper-lazy">
            </a>
            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </div>
        
    </div>
    <div class="swiper-pagination swiper-pagination-clickable"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
</section>


<nav>
    <a href="/licences"><i></i><span>牌照并购</span></a>
    <a href="/licences/create"><i></i><span>发布牌照</span></a>
    <a href="/"><i></i><span>企业服务</span></a>
</nav>

<section class="productGood2">
    <div class="tit">
        <h2><s>•</s>企业信息<s>•</s></h2>
    </div>
    <div class="con">
        <h3 style="margin-bottom:10px;"><i class="iconFont"></i>联系QQ: <a href="mqqwpa://im/chat?chat_type=wpa&uin=7775158&version=1&src_type=web&web_src=bjhuli.com">7775158</a></h3>
        <h3><i class="iconFont"></i>联系电话: 188-888-8888</h3>
    </div>
</section>
{{--
<section class="dzzs">
    <h3 class="h3"><i class="iconFont"></i>最近成交指数</h3>
    <div>
        <p>67<i>%</i><b class="up"></b></p>
        <span>已完成</span>
    </div>
    <div>
        <p>24<i>%</i><b class="up"></b></p>
        <span>进行中</span>
    </div>
</section>
--}}

<a href="/" class="onlineItem fixb"><span>459</span><b>个</b><br>在线可交易牌照</a>

<footer class="bottomBar">
    <ul><!-- 当前状态是span标签的，可点击的是a标签的 -->
        <!--li><a href=""><i class="iconFont">&#xe606;</i>项目</a></li-->
        <li><a href="/" class="act"><i class="iconFont"></i>首页</a></li>
        <li><a href="/licences" class=""><i class="iconFont"></i>牌照</a></li>
        <li class="funcUnsupported"><span><i class="iconFont"></i></span></li>
        <li><a href="/" class=""><i class="iconFont"></i>资讯</a></li>
        <li><a href="/user-messages" class=""><i class="iconFont"></i>留言</a></li>
    </ul>
</footer>
<script src="{{ asset('js/swiper.js') }}"></script>
<script src="{{ asset('js/zepto.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        lazyLoading: true
    });
    $(function(){
        $('.funcUnsupported').on('tap', function(){
            swal({
              title: "",
              text: "亲，请选择您的牌照需求",
              type: 'success',
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "买牌照",
              cancelButtonText: "卖牌照",
              timer: 2000, 
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm){
              if (isConfirm) {
                window.location.href="/user-messages"
              } else {
                window.location.href="/licences/create"
              }
            });
        })
    })
</script>
</body></html>