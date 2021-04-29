<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="后台首页">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="/admin/assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/admin/assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <link rel="stylesheet" href="/admin/assets/css/amazeui.min.css"/>
    <link rel="stylesheet" href="/admin/assets/css/admin.css">
    <script src="/admin/assets/js/jquery.min.js"></script>
    <!--<![endif]-->

    <script src="/admin/assets/js/amazeui.min.js"></script>
    <script src="/admin/assets/js/app.js"></script>
    <script src="/admin/assets/js/admin.js"></script>
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
    以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar  admin-header">
    <div class="am-topbar-brand">
        <strong>明日科技</strong> <small>后台管理</small>
    </div>
    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
            data-am-collapse="{target: '#topbar-collapse'}">
        <span class="am-sr-only">导航切换</span>
        <span class="am-icon-bars"></span>
    </button>

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
            <li>
                <a href="javascript:;">
                    <span class="am-icon-envelope-o"></span> 收件箱
                    <span class="am-badge am-badge-warning">6</span>
                </a>
            </li>
            <li class="am-dropdown" data-am-dropdown>
                @if(Auth::check())
                <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                    <span class="am-icon-users"> {{Auth::user()->username}},欢迎</span>
                    <span class="am-icon-caret-down"></span>
                </a>
                <ul class="am-dropdown-content">
                    <li><a href="/adm/user/edit-user/{{Auth::user()->id}}"><span class="am-icon-paste"></span> 修改密码</a></li>
                    <li><a href="/logout"><span class="am-icon-power-off"></span> 退出</a></li>
                </ul>
            </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/login" >登录</a>
                </li>
            @endif
            <li class="am-hide-sm-only">
                <a href="javascript:;" id="admin-fullscreen">
                    <span class="am-icon-arrows-alt"></span>
                    <span class="admin-fullText">开启全屏</span>
                </a>
            </li>
        </ul>
    </div>
</header>

<div class="am-cf admin-main">
    <!-- sidebar start -->
    <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
        <div class="am-offcanvas-bar admin-offcanvas-bar">
            <ul class="am-list admin-sidebar-list">
                <li><a href="/adm"><span class="am-icon-home"></span> 首页</a></li>
                <li><a href="/adm/user"><span class="am-icon-user"></span> 用户管理</a></li>
                <li><a href="/adm/news"><span class="am-icon-file"></span> 新闻管理</a></li>
                <li><a href="/logout"><span class="am-icon-sign-out"></span> 注销</a></li>
            </ul>

            <div class="am-panel am-panel-default admin-sidebar-panel">
                <div class="am-panel-bd">
                    <p><span class="am-icon-bookmark"></span> 公告</p>
                    <p>时光静好，与君语；细水流年，与君同。—— Amaze UI</p>
                </div>
            </div>

            <div class="am-panel am-panel-default admin-sidebar-panel">
                <div class="am-panel-bd">
                    <p><span class="am-icon-tag"></span> wiki</p>
                    <p>Welcome to the Amaze UI wiki!</p>
                </div>
            </div>
        </div>
    </div>
    <!-- sidebar end -->
    <!-- content start -->
    @yield('content')
    <!-- content end -->
</div>
<a href="#" class="am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}">
    <span class="am-icon-btn am-icon-th-list"></span>
</a>

<footer>
    <hr>
    <p class="am-padding-left" style="text-align: center">© 2020 AllMobilize, Inc. Licensed under MIT license.</p>
</footer>

</body>
</html>