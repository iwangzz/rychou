<!DOCTYPE html>
<!-- saved from url=(0036)http://m.roadshowcenter.com/dxzfList -->
<html data-dpr="1" style="font-size: 25.75px;">
<head>
<title>聂丰投资</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="format-detection" content="telephone=no, email=no">
<meta name="screen-orientation" content="portrait"><!-- uc强制竖屏 -->
<meta name="x5-orientation" content="portrait"><!-- QQ强制竖屏 -->
<script src="{{ asset('js/newRem.js') }}"></script>
<link rel="stylesheet" href="{{ elixir('css/licence.css') }}">
</head>

<body>
<header class="topBar">
    <a href="http://jijin.com" class="f_l"><i class="iconFont"></i></a><a href="http://jijin.com" class="f_r"><!-- <i class="iconFont">&#xe615;</i> --></a>在线牌照列表
</header>

<section class="tabList fixF">
    <a class="act">默认</a>
    {{--<a onclick="clickFilter()" style="float:right;">筛选<i class="iconFont"></i></a>--}}
</section>

<ol class="listN fixM">
    @foreach($licences as $licence)
        <li data-id={{ $licence->id }}>
            <span class="opt"><i class="iconFont"></i></span>  
            <div class="hd"><h4><a href="/licences/{{$licence->id}}">{{ $categories[$licence->category] }}</a></h4></div>    
            <div class="bd">        
                <span class="mj"><b>{{ $licence->price }}<i>万元</i></b><b>牌照价格</b></span>
                <span class="ya"><b>62.67<i>%</i></b><b>价差率</b></span>        
                <span class="zf"><b style="font-size:14px">一年期竞价</b><b>增发类型</b></span>    
            </div>    
            <div class="ft"> 
                <span class="price">所属地区：{{ $regions[$licence->region] }}</span>        
                <span class="user">项目进度 证监会批准</span>        
                <span class="focus">关注<b class="num">{{ $licence->collection }}</b>人</span>    
            </div>
        </li>
    @endforeach
</ol>

<script src="{{ asset('js/zepto.min.js') }}"></script>
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