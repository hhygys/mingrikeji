<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>明日科技有限公司</title>
    <link href="/front/assets/css/main.css" rel="stylesheet" type="text/css">
    <link href="/front/assets/css/container.css" rel="stylesheet" type="text/css">
    <link href="/front/assets/css/reset.css" rel="stylesheet" type="text/css">
    <link href="/front/assets/css/screen.css" rel="stylesheet" type="text/css">
    <script src="/front/assets/js/jquery.min.js"></script>
    <script src="/front/assets/js/tab.js"></script>
    <script src="/admin/assets/js/admin.js"></script>

</head>

<body>
<!-- 头部 -->
<div class="header_bg">
    <div class="wrap">
        <div class="header">
            <div class="logo">
                <a href="/"><img src="/front/assets/img/logo.png" alt=""></a>
            </div>
            <div class="pull-icon">
                <a id="pull"></a>
            </div>
            <div class="cssmenu">
                <ul>
                    <li><a href="/">首页</a></li>
                    <li><a href="/front/about">企业简介</a></li>
                    <li><a href="/front/newslist">新闻</a></li>
                    <li><a href="/front/content">核心竞争力</a></li>
                    <li class="last"><a href="/front/contact">联系我们</a></li>
                </ul>
            </div>
            <!--清除浮动-->
            <div class="clear"></div>
        </div>
    </div>
</div>
<!--头部-->
<!--banner-->
<div class="second_banner"><img src="/front/assets/img/3.gif" alt=""></div>
<!--//banner-->

<!--新闻-->
<div class="container">
    <div class="left">
        <div class="menu_plan">
            <div class="menu_title">公司动态<br><span>news of company</span></div>
            <ul id="tab">
                <li><a href="#">公司新闻</a>
            </ul>
        </div>
    </div>
    <div class="right">
        <div class="location">
				<span>当前位置：<a href="javascript:void(0)"><a href="#">公司新闻</a></a></span>
            <div class="brief" id="b">
                <a href="#">公司新闻</a>
            </div>
        </div>
        <div style="font-size: 14px; margin-top: 53px; line-height: 36px;">
            <div id="tab_con">
                <div id="tab_con_2" class="dis-n" style="display: none;">
                    <table style="margin-top: 70px">
                        <tbody>
                        <tr class="tt_bg">
                            <td>新闻标题</td>
                            <td>发布人</td>
                            <td>类型</td>
                            <td>发布时间</td>
                            <td>详情</td>
                        </tr>
                        @foreach($news as $v)
                            <tr>

                                <td>{{$v->title}}</td>
                                <td>{{$v->publisher}}</td>
                                <td>@if($v->type == 1)国内新闻@else国际新闻@endif</td>
                                <td class="am-hide-sm-only">{{$v->updated_at}}</td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <input type="hidden" value="{{$v->id}}"/>
                                            <a href="/front/newsdetail/{{$v->id}}"><span class="am-icon-pencil-square-o"></span> 新闻详情</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{$news->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--页面底部开始-->
<div class="bottom">
    <div class="footer">
        <div class="gulid">
            <p>Copyright 2021 明日科技有限公司 All Rights.</p>
            <p>
                <a href="http://www.mingrisoft.com">明日科技</a> 技术支持
                <a href="/adm">后台</a>
            </p>
            <p>吉ICP备 10002740号-2 吉公网安备22010202000132号</p>
        </div>
    </div>
</div>

</body>
<script>
    tabs("#tab", "active", "#tab_con");
</script>
</html>