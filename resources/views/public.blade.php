<!DOCTYPE html>
<html lang="en">
<head>
    @yield('title')
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('/css/reset.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('/css/slider.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('/css/custom.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300' rel='stylesheet' type='text/css'>
    <script src="{{ asset('/js/jquery-1.7.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('/js/tms-0.4.1.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.slider')._TMS({
                show:0,
                pauseOnHover:true,
                prevBu:'.prev',
                nextBu:'.next',
                playBu:false,
                duration:500,
                preset:'fade',
                pagination:true,//'.pagination',true,'<ul></ul>'
                pagNums:false,
                slideshow:8000,
                numStatus:false,
                banners:'fromBottom',// fromLeft, fromRight, fromTop, fromBottom
                waitBannerAnimation:false,
                progressBar:false
            })

        })
        $(function(){
            if($(window).width() <= 1066)
            {
                $("#slider .prev").css("left", "55px")
                $("#slider .next").css("right", "55px")
            }
        })
    </script>
    <!--[if lt IE 8]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
            <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
    </div>
    <![endif]-->
    <!--[if lt IE 9]>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="{{ asset('/js/html5.js') }}"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('/css/ie.css') }}">
    <![endif]-->
</head>
<body>
<div class="bg">
    <header>
        <div class="main wrap">
            <h1><a href="{{ url('/') }}"><img src="{{ asset('/images/logo.png') }}"></a></h1>
            <p>Москва, ул.Вагоностроителей стр.5 <span>8 (800) 552 5975</span></p>
        </div>
        <nav>
            <ul class="menu" id="nav">
                {{--<li class="current"><a href="{{ url('/') }}" class="home"><img src="{{ asset('/images/home.jpg') }}"></a></li>--}}
                <li><a href="#">О компании</a></li>
                <li><a href="#">Информация для поставщиков</a></li>
                <li>
                    <a href="#">Покупки</a>
                    <ul>
                        <li>{!! link_to_route('trainCar','Детали товарных вагонов') !!}</li>
                        <li>{!! link_to_route('trainCarService','Услуги по грузовым вагонам') !!}</li>
                    </ul>
                </li>
                <li class="current"><a href="#">Контакты</a></li>
                @if (Auth::guest())
                    <li>
                        <a href="{{ url('/auth/login') }}">Войти</a>
                        <ul>
                            <li><a href="{{ url('/auth/register') }}">Зарегистрироваться</a></li>
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="{{ url('/cabinet') }}">Личный кабинет</a>
                        <ul>
                            <li><a href="{{ url('/auth/logout') }}">Выйти</a></li>
                        </ul>
                    </li>
                @endif

            </ul>
            <div class="clear"></div>
        </nav>
    </header>
    <!--==============================content================================-->
    @yield('content')
    <!--==============================footer=================================-->
    <footer>
        Copyright © 2016 Transgarant. All Rights Reserved.
    </footer>
</div>
    @yield('jsScripts')
</body>
</html>