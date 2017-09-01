<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel App</title>
    {{--<link rel="stylesheet" href="/css/bootstrap.css">--}}
    <link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="/Font-Awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/jquery.Jcrop.css">
    {{--<script src="/js/jquery-2.1.4.min.js"></script>--}}
    {{--<script src="/js/jquery.form.js"></script>--}}
    <script src="/js/jquery-2.1.4.min.js"></script>
    <script src="/js/jquery.Jcrop.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/jquery.form.js"></script>
    <script src="/js/vue.min.js"></script>
    <script src="/js/vue-resource.js"></script>
    <meta id="token" name="token" value="{{ csrf_token() }}">
</head>

<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Laravel App</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">首页</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../navbar/">Default</a></li>
                @if(Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="/user/avatar"> <i class="fa fa-user" aria-hidden="true"></i> 更换头像</a></li>
                            <li><a href="#"> <i class="fa fa-cog" aria-hidden="true"></i> 更换密码</a></li>
                            <li><a href="#"> <i class="fa fa-heart" aria-hidden="true"></i> 特别感谢</a></li>
                            <li role="separator" class="divider"></li>
                            <li> <a href="/logout">  <i class="fa fa-sign-out"></i> 退出登录</a></li>
                        </ul>
                    </li>
                    {{--<li class="active"><a href="/logout">退出登录</a></li>--}}
                    <li><img src="{{Auth::user()->avatar}}" class="img-circle" width="50" height="50" alt="photo"></li>

                @else
                <li><a href="/user/login">登录</a></li>
                <li><a href="/user/register">注册</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
 @yield('content')
{{--<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
{{--<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>--}}

{{--<script src="/js/jquery-2.1.4.min.js"></script>--}}
{{--<script src="/js/bootstrap.js"></script>--}}
{{--<script src="/js/jquery.form.js"></script>--}}
</body>

</html>