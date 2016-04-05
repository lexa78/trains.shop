<!DOCTYPE html>
<html lang="en">
<head>
    <title>Запрашиваемая страница не найдена</title>
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
            <p><span>8 (495) 542-94-38</span></p>
        </div>
        <nav>
            <ul class="menu" id="nav">
                <li>{!! link_to_route('main','Главная') !!}</li>
                <li>{!! link_to_route('about','О компании') !!}</li>
                <li>{!! link_to_route('info','Для поставщиков') !!}</li>
                <li>
                    <a href="#">Каталог товаров/услуг</a>
                    <ul>
                        <li>{!! link_to_route('trainCar','Каталог запчастей грузовых вагонов') !!}</li>
                        <li>{!! link_to_route('trainCarService','Услуги по грузовым вагонам') !!}</li>
                    </ul>
                </li>
                <li>{!! link_to_route('contacts','Контакты') !!}</li>
                @if (Auth::guest())
                    <li>
                        <a href="{{ url('/auth/login') }}">Войти</a>
                        <ul>
                            <li><a href="{{ url('/auth/register') }}">Зарегистрироваться</a></li>
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="#">Личный кабинет<br>{{ Auth::user()->firm->organisation_name }}</a>
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
    @if (session('successRegister'))
        <div class="alert alert-success">
            {{ session('successRegister') }}
        </div>
        @endif

                <!--==============================content================================-->
        <section id="content"><div class="ic"></div>
            <div class="sub-page">
                <div class="sub-page-left">
                    <div class="wrap">
                        <div class="extra-wrap">

                            <p><strong>Запрошенная страница не была найдена. Возможно, она была перенесена или удалена за ненадобностью.</strong></p>

                            <h3>Попробуйте поискать нужную Вам информацию в других разделах нашего сайта</h3>

                            <hr>

                            <div class="row-fluid">
                                <div class="span10">
                                    <p>Начните с {!! link_to_route('main','Главной') !!} - страницы.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--==============================footer=================================-->
</div>
<footer>
    &copy; Общество с ограниченной ответственностью «Гатис».  Телефон/факс: 8 (495) 542-94-38. Электронная почта: info@transgatis.com
</footer>
</body>
</html>