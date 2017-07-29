<!DOCTYPE html>
<!-- saved from url=(0036)http://m.roadshowcenter.com/dxzfList -->
<html data-dpr="1" style="font-size: 25.75px;">
<head>
<title>金融牌照交易</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="format-detection" content="telephone=no, email=no">
<meta name="screen-orientation" content="portrait"><!-- uc强制竖屏 -->
<meta name="x5-orientation" content="portrait"><!-- QQ强制竖屏 -->
<script src="{{ asset('js/newRem.js') }}"></script>
<script src="{{ asset('js/jquery-1.8.2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/demo.css') }}">
<link rel="stylesheet" href="{{ elixir('css/licence.css') }}">
</head>

<body>
<header class="topBar">
    <a href="/" class="f_l"><i class="iconFont"></i></a><a href="/" class="f_r"><!-- <i class="iconFont">&#xe615;</i> --></a>在线牌照列表
</header>

<section class="tabList fixF" style="margin-top:0.2rem;">
    <a class="act">默认</a>
    {{--<a onclick="clickFilter()" style="float:right;">筛选<i class="iconFont"></i></a>--}}
</section>
<div class="screening">
    <ul>
        <li class="default current"><span>默认</span></li>
        <li class="Brand"><span>价格区间</span></li>
        <li class="Sort"><span>牌照分类</span></li>
        <li class="meishi"><span>更多</span></li>
    </ul>
</div>

<!-- 企业性质-->
<div class="Sort-eject Sort-height">
    <ul class="Sort-Sort" id="Sort-Sort">
        <li onclick="Sorts(this)"><a href="/licences?c=0" style="color:#000;">不限</a></li>
        @foreach($categories as $id => $name) 
            <li onclick="Sorts(this)"><a href="/licences?c={{$id}}" style="color:#000;">{{ $name }}</a></li>
        @endforeach
    </ul>
</div>

<!--专业-->
<div class="Category-eject">
    <ul class="Category-w" id="Categorytw">
        <li onclick="Categorytw(this)"><a href="/licences?p=0" style="color:#000;">不限</a></li>
        <li onclick="Categorytw(this)"><a href="/licences?p=1" style="color:#000;">10-20万</a></li>
        <li onclick="Categorytw(this)"><a href="/licences?p=2" style="color:#000;">20-50万</a></li>
        <li onclick="Categorytw(this)"><a href="/licences?p=3" style="color:#000;">50-100万</a></li>
        <li onclick="Categorytw(this)"><a href="/licences?p=4" style="color:#000;">100-200万</a></li>
        <li onclick="Categorytw(this)"><a href="/licences?p=5" style="color:#000;">> 200万</a></li>
    </ul>
</div>
<!-- End 专业 -->

<!-- 更多 -->
<div class="meishi22">
    <ul class="meishia-w" id="meishia">
        <li><a href="/user-messages" style="color:#000;">发布买牌照</a></li>
        <li><a href="/licences/create" style="color:#000;">发布卖牌照</a></li>
    </ul>
</div>

<ol class="listN fixM">
    @foreach($licences as $licence)
        <li data-id={{ $licence->id }}>
            <div class="hd">
                <h4>{{ $categories[$licence->category] }}</h4>
                <a  href="/user-messages?id={{ $licence->id }}" style="display:inline-block;float:right;color:#38a2ff;"><i class="iconFont"></i></a>
            </div>    
            <div class="bd">        
                <span class="mj"><b>{{ round($licence->price) }}<i>万元</i></b><b>转让价格</b></span>
                {{--<span class="ya"><b>62.67<i>%</i></b><b>价差率</b></span>--}}
                <span class="ya"></span>    
                <span class="zf"><b style="font-size:14px">牌照类型</b><b>{{ $categories[$licence->category] }}</b></span>    
            </div>    
            <div class="ft"> 
                <span class="price">所属地区：{{ $regions[$licence->region] }}</span>        
                {{--<span class="user">项目进度 证监会批准</span>--}}
                <span class="user"></span>        
                <span class="focus">关注<b class="num">{{ $licence->collection }}</b>人</span>    
            </div>
        </li>
    @endforeach
</ol>

<script src="{{ asset('js/zepto.min.js') }}"></script>
<script src="{{ asset('js/demo.js') }}"></script>
<script>
function clickFilter(){
    var sortType = $("#sortType").val();
    var sortDesc = $("#sortDesc").val();
    var sortParam = {
        sortType:sortType,
        sortDesc:sortDesc
    }
    post("/licences",sortParam);
}

//用post方法跳转到url,参数为paramsSort+paramsFilter
function post(url, paramsSort) {
    var form = document.createElement("form");
    form.action = url;
    form.method = "post";
    form.style.display = "none";
    // 已有的筛选条件
    var paramsFilter = {
        priceRateMin:null,
        priceRateMax:null,
        feeExpectMin:null,
        feeExpectMax:null,
        industry:null,
        lastDxzfFlow:null,
        city:null,
        province:null,
        companyType:null,
        purpose:null,
        bigShareholder:null
    }
    // 已有的筛选条件
    for (var param in paramsFilter) {
        var textarea = document.createElement("textarea");
        textarea.name = param;
        textarea.value = paramsFilter[param];
        form.appendChild(textarea);
    }
    // 已有的排序条件
    for (var param in paramsSort) {
        var textarea = document.createElement("textarea");
        textarea.name = param;
        textarea.value = paramsSort[param];
        form.appendChild(textarea);
    }
    document.body.appendChild(form);
    form.submit();
    return form;
}

Zepto(function($){
    
    var pageNo=1;//当前页
    var pageSize=5;//每页数量
    var ajax=!1;//是否加载中
    var nextPageNo = 2;
    var hostId = 0;
    
    $.ajax({
        type: 'POST',
        url: './moreDxzfList.json',
        traditional: true,
        data: {
                pageSize:pageSize,
                pageNo:pageNo,
                sortType:'normal',
                sortDesc:1,
                priceRateMin:null,
                priceRateMax:null,
                feeExpectMin:null,
                feeExpectMax:null,
                industry:null,
                lastDxzfFlow:null,
                city:null,
                province:null,
                companyType:null,
                purpose:null,
                bigShareholder:null
          },
        dataType: 'json',
        success: function (json) {
            if (json.errorcode == 0) {
                hostId = json.data.hostId;
                for (var i=0; i<json.data.dxzfList.length; i++) {
                    var strTag = '';
                    var strFollow = '';

                    for (var j=0; j<json.data.dxzfList[i].dxzfTagList.length; j++) {
                        strTag+='<b style="color:'+json.data.dxzfList[i].dxzfTagList[j].tagColor+'">'+json.data.dxzfList[i].dxzfTagList[j].tagName+'</b>'
                    }

                    if (json.data.dxzfList[i].followed) {
                        strFollow = '<span class="opt focused"><i class="iconFont">&#xe614;</i></span>'
                    } else {
                        strFollow = '<span class="opt"><i class="iconFont">&#xe613;</i></span>'
                    }

                    if (json.data.dxzfList[i].ownerId == json.data.hostId) {
                        strFollow = '<span class="opt my"><i class="iconFont">&#xe616;</i></span>';
                    }

                    var fontSize= parseInt(26/45*parseFloat(document.querySelector('html').style.fontSize))+"px";
                    var col3Display = "<b style='font-size:"+fontSize+"'>"+json.data.dxzfList[i].col3ValDisplay+"</b>";
                    
                    $('.listN').append(
                        '<li data-id='+json.data.dxzfList[i].id+'>'+
                        strFollow +
                        '    <div class="hd">'+
                        '        <h4>'+json.data.dxzfList[i].listcoName+'</h4><span class="code">['+json.data.dxzfList[i].listcoCode+']</span><span class="tag">'+strTag+'</span>'+
                        '    </div>'+
                        '    <p>'+json.data.dxzfList[i].listcoIndustry1Name+' - '+json.data.dxzfList[i].listcoIndustry3Name+'</p>'+
                        '    <div class="bd">'+
                        '        <span class="mj"><b>'+json.data.dxzfList[i].col1ValDisplay+'<i>'+json.data.dxzfList[i].col1UnitDisplay+'</i></b><b>'+json.data.dxzfList[i].col1Display+'</b></span>'+
                        '        <span class="ya"><b>'+json.data.dxzfList[i].col2ValDisplay+'<i>'+json.data.dxzfList[i].col2UnitDisplay+'</i></b><b>'+json.data.dxzfList[i].col2Display+'</b></span>'+
                        '        <span class="zf">'+col3Display+'<b>'+json.data.dxzfList[i].col3Display+'</b></span>'+
                        '    </div>'+
                        '    <div class="ft">'+
                        '        <span class="price">'+json.data.dxzfList[i].botCol1Display+' '+json.data.dxzfList[i].botCol1ValDisplay+json.data.dxzfList[i].botCol1UnitDisplay+'</span>'+
                        '        <span class="user">'+json.data.dxzfList[i].botCol2Display+' '+json.data.dxzfList[i].botCol2ValDisplay+json.data.dxzfList[i].botCol2UnitDisplay+'</span>'+
                        '        <span class="focus">关注<b class="num">'+json.data.dxzfList[i].followAmount+'</b>人</span>'+
                        '    </div>'+
                        '</li>'
                    );
                }
                //$(".loading").remove();//删除加载图片
                ajax=!1;//注明已经完成ajax加载
                if (json.data.nextPageNo != -1) {
                    pageNo++;//当前页增加1
                } else {
                    nextPageNo = -1;
                }
            }
        }
    });

    $(window).scroll(function(){
        if(($(window).scrollTop() + $(window).height() > $(document).height()-40) && !ajax && nextPageNo >=1) {
            //滚动条拉到离底40像素内，而且没ajax中，而且没超过总页数
            ajax=!0;//注明开始ajax加载中
            //$(".list").append('<div class="loading"><img src="/template/mobile/loading.gif" alt="" /></div> ');//出现加载图片
            $.ajax({
                 type: 'POST',
                 url: './moreDxzfList.json',
                 traditional: true,
                 data: {
                    pageSize:pageSize,
                    pageNo:pageNo,
                    sortType:'normal',
                    sortDesc:1,
                    priceRateMin:null,
                    priceRateMax:null,
                    feeExpectMin:null,
                    feeExpectMax:null,
                    industry:null,
                    lastDxzfFlow:null,
                    city:null,
                    province:null,
                    companyType:null,
                    purpose:null,
                    bigShareholder:null
                },
                dataType: 'json',
                success: function (json) {
                    if (json.errorcode == 0) {
                        for (var i=0; i<json.data.dxzfList.length; i++) {
                            var strTag = '';
                            var strFollow = '';

                            for (var j=0; j<json.data.dxzfList[i].dxzfTagList.length; j++) {
                                strTag+='<b style="color:'+json.data.dxzfList[i].dxzfTagList[j].tagColor+'">'+json.data.dxzfList[i].dxzfTagList[j].tagName+'</b>'
                            }

                            if (json.data.dxzfList[i].followed) {
                                strFollow = '<span class="opt focused"><i class="iconFont">&#xe614;</i></span>'
                            } else {
                                strFollow = '<span class="opt"><i class="iconFont">&#xe613;</i></span>'
                            }

                            if (json.data.dxzfList[i].ownerId == json.data.hostId) {
                                strFollow = '<span class="opt my"><i class="iconFont">&#xe616;</i></span>';
                            }

                            //var col3Display = json.data.dxzfList[i].col3ValDisplay;
                            //var fontSize= parseInt(26/45*parseFloat(document.querySelector('html').style.fontSize))+"px";
                            //var col3Display = /[\u4e00-\u9fa5]/.test(col3Display)?"<b style='font-size:"+fontSize+"'>"+col3Display+"</b>":"<b>"+col3Display+"</b>";
                            
                            var fontSize= parseInt(26/45*parseFloat(document.querySelector('html').style.fontSize))+"px";
                            var col3Display = "<b style='font-size:"+fontSize+"'>"+json.data.dxzfList[i].col3ValDisplay+"</b>";
                            
                            $('.listN').append(
                                '<li data-id='+json.data.dxzfList[i].id+'>'+
                                strFollow +
                                '    <div class="hd">'+
                                '        <h4>'+json.data.dxzfList[i].listcoName+'</h4><span class="code">['+json.data.dxzfList[i].listcoCode+']</span><span class="tag">'+strTag+'</span>'+
                                '    </div>'+
                                '    <p>'+json.data.dxzfList[i].listcoIndustry1Name+' - '+json.data.dxzfList[i].listcoIndustry3Name+'</p>'+
                                '    <div class="bd">'+
                                '        <span class="mj"><b>'+json.data.dxzfList[i].col1ValDisplay+'<i>'+json.data.dxzfList[i].col1UnitDisplay+'</i></b><b>'+json.data.dxzfList[i].col1Display+'</b></span>'+
                                '        <span class="ya"><b>'+json.data.dxzfList[i].col2ValDisplay+'<i>'+json.data.dxzfList[i].col2UnitDisplay+'</i></b><b>'+json.data.dxzfList[i].col2Display+'</b></span>'+
                                '        <span class="zf">'+col3Display+'<b>'+json.data.dxzfList[i].col3Display+'</b></span>'+
                                '    </div>'+
                                '    <div class="ft">'+
                                '        <span class="price">'+json.data.dxzfList[i].botCol1Display+' '+json.data.dxzfList[i].botCol1ValDisplay+json.data.dxzfList[i].botCol1UnitDisplay+'</span>'+
                                '        <span class="user">'+json.data.dxzfList[i].botCol2Display+' '+json.data.dxzfList[i].botCol2ValDisplay+json.data.dxzfList[i].botCol2UnitDisplay+'</span>'+
                                '        <span class="focus">关注<b class="num">'+json.data.dxzfList[i].followAmount+'</b>人</span>'+
                                '    </div>'+
                                '</li>'
                            );
                        }
                        //$(".loading").remove();//删除加载图片
                        ajax=!1;//注明已经完成ajax加载
                        if (json.data.nextPageNo != -1) {
                            pageNo++;//当前页增加1
                        } else {
                            nextPageNo = -1;
                        }
                    }
                }
            });
        }
    });
});

</script>
</body></html>