<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('/css/reset.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('/css/slider.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('/css/custom.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300' rel='stylesheet' type='text/css'>

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
            <p class="purchases_cart">@yield('purchases_cart')</p>
            <p>Москва, ул.Вагоностроителей стр.5 <span>8 (800) 552 5975</span></p>
        </div>
        <nav>
            <ul class="menu" id="nav">
                {{--<li class="current"><a href="{{ url('/') }}" class="home"><img src="{{ asset('/images/home.jpg') }}"></a></li>--}}
                <li class="{{ ($p == 'about') ? 'current' : null}}"><a href="#">О компании</a></li>
                <li  class="{{ ($p == 'info') ? 'current' : null}}"><a href="#">Информация для поставщиков</a></li>
                <li  class="{{ ($p == 'purchases') ? 'current' : null}}">
                    <a href="#">Покупки</a>
                    <ul>
                        <li>{!! link_to_route('trainCar','Детали товарных вагонов') !!}</li>
                        <li>{!! link_to_route('trainCarService','Услуги по грузовым вагонам') !!}</li>
                    </ul>
                </li>
                <li  class="{{ ($p == 'contacts') ? 'current' : null}}"><a href="#">Контакты</a></li>
                @if (Auth::guest())
                    <li  class="{{ ($p == 'login') ? 'current' : null}}">
                        <a href="{{ url('/auth/login') }}">Войти</a>
                        <ul>
                            <li><a href="{{ url('/auth/register') }}">Зарегистрироваться</a></li>
                        </ul>
                    </li>
                @else
                    <li  class="{{ ($p == 'cabinet') ? 'current' : null}}">
                        <a href="#">Личный кабинет</a>
                        <ul>
                            <li><a href="{{ route('firm.edit') }}">Редактировать информацию о фирме</a></li>
                            <li><a href="{{ route('showMyOrders') }}">Мои заказы</a></li>
                            <li><a href="{{ route('showMyDocs') }}">Мои документы</a></li>
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