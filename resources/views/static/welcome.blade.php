@extends('public')

@section('title')
    Запчасти для грузовых вагонов
@stop

@section('content')
    <div id="slider">
        <div class="slider-block">
            <div class="slider">
                <ul class="items">
                    <li><img src="{{ asset('/images/slide-1.jpg') }}" alt="" /><div class="banner"><div><a href="{{ URL::route('trainCarPriceListInCategory',['category_name'=>'Автосцепки', 'depoId'=>\App\Models\Stantion::where('id','>','0')->first()]) }}"><span>Автосцепка</span></a><p><a href="{{ URL::route('trainCarPriceListInCategory',['category_name'=>'Автосцепки', 'depoId'=>\App\Models\Stantion::where('id','>','0')->first()]) }}">Автосцепка состоит из следующих частей: корпуса автосцепки и расположенного в нём механизма, тягового устройства с пружинами, расцепного привода и ударно-центрирующего прибора.</a></p></div></div></li>
                    <li><img src="{{ asset('/images/slide-2.jpg') }}" alt="" /><div class="banner"><div><a href="{{ URL::route('trainCarPriceListInCategory',['category_name'=>'Балки надрессорные', 'depoId'=>\App\Models\Stantion::where('id','>','0')->first()]) }}"><span>Надрессорная балка</span></a><p><a href="{{ URL::route('trainCarPriceListInCategory',['category_name'=>'Балки надрессорные', 'depoId'=>\App\Models\Stantion::where('id','>','0')->first()]) }}">Надрессорная балка в конструкции тележки грузового вагона служит соединительным звеном между двумя рамами боковыми.</a></p></div></div></li>
                    <li><img src="{{ asset('/images/slide-3.jpg') }}" alt="" /><div class="banner"><div><a href="{{ URL::route('trainCarPriceListInCategory',['category_name'=>'Колесные пары', 'depoId'=>\App\Models\Stantion::where('id','>','0')->first()]) }}"><span>Колесная пара</span></a><p><a href="{{ URL::route('trainCarPriceListInCategory',['category_name'=>'Колесные пары', 'depoId'=>\App\Models\Stantion::where('id','>','0')->first()]) }}">Колесные пары предназначены для направления движения вагона по рельсовому пути и восприятия всех нагрузок, передающихся от вагона на рельсы при их вращении.</a></p></div></div></li>
                </ul>
            </div>
            <a href="#" class="prev"></a>
            <a href="#" class="next"></a>
        </div>
    </div>
    <!--==============================content================================-->
    <section id="content"><div class="ic"></div>
        <div class="block-1 box-1">
            <div>
                <a href="{{ URL::route('trainCar') }}"><img src="{{ asset('images/page1-img1.jpg') }}" alt=""></a>
                {!! $l_p_text !!}
            </div>
            <div>
                <a href="{{ URL::route('trainCarService') }}"><img src="{{ asset('images/page1-img2.jpg') }}" alt=""></a>
                {!! $r_p_text !!}
            </div>
        </div>

        <div class="wrap with-bg">
            <div class="extra-wrap">
                {!! $text !!}
            </div>
        </div>
    </section>

@stop

@section('jsScripts')
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
@stop
