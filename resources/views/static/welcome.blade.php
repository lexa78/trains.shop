@extends('public')

@section('title')
    Запчасти для грузовых вагонов
@stop

@section('content')
    <div id="slider">
        <div class="slider-block">
            <div class="slider">
                <ul class="items">
                    <li><img src="{{ asset('/images/slide-1.jpg') }}" alt="" /><div class="banner"><div><span>Автосцепка</span><strong>Производство: Россия, УралВагонЗавод</strong><p>Автосцепка состоит из следующих частей: корпуса автосцепки и расположенного в нём механизма, тягового устройства с поглощающим аппаратом (пружинами), расцепного привода и ударно-центрирующего прибора.</p></div></div></li>
                    <li><img src="{{ asset('/images/slide-2.jpg') }}" alt="" /><div class="banner"><div><span>Надрессорная балка</span><strong>Производство: Россия, УралВагонЗавод</strong><p>Надрессорная балка в конструкции тележки грузового вагона служит соединительным звеном между двумя рамами боковыми. Для обеспечения надежности и долговечности балку надрессорную отливают из стали 20ГФЛ или 20ГЛ.</p></div></div></li>
                    <li><img src="{{ asset('/images/slide-3.jpg') }}" alt="" /><div class="banner"><div><span>Колесная пара</span><strong>Производство: Россия, УралВагонЗавод</strong><p>Колесные пары предназначены для направления движения вагона по рельсовому пути и восприятия всех нагрузок, передающихся от вагона на рельсы при их вращении.</p></div></div></li>
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
                <a href="{{ URL::route('trainCar') }}"><p class="text-1">Запчасти для грузовых вагонов</p></a>
                <p>Огромный выбор запчастей. От автосцепки до колесной пары.</p>
            </div>
            <div>
                <a href="{{ URL::route('trainCarService') }}"><img src="{{ asset('images/page1-img2.jpg') }}" alt=""></a>
                <a href="{{ URL::route('trainCarService') }}"><p class="text-1">Услуги по грузовым вагонам</p></a>
                <p>Мы предоставляем широкий спектр услуг, связанных с грузовыми вагонами. От инструментального обмера вагонов до организации отстоя вагонов.</p>
            </div>
        </div>

        <div class="wrap with-bg">
            <div class="extra-wrap">
                <p>ООО "Гатис" специализируется на поставках запасных частей к грузовым вагонам.</p>
                <p>На нашем сайте вы можете приобрести колесные пары, боковые рамы, надрессорные балки и прочее оборудование. Все запчасти, представленные в каталоге сайта, есть в наличии, и будут отгружены покупателю в течение максимум трех дней после оплаты счета. Условия поставки отражены в договоре оферты.</p>
                <br>
                <p>Помимо продажи запасных частей  вагонов, ООО "Гатис" оказывает следующие услуги:</p>
                <ul class="list-2">
                    <li>организация приписки вагонов</li>
                    <li>организация регистрации/перерегистрации вагонов</li>
                    <li>организация технического осмотра вагонов</li>
                    <li>организация технической приемки вагонов</li>
                    <li>создание и поддержание базы технических паспортов</li>
                    <li>предоставление сведений о дислокации и технических характеристиках вагонов</li>
                    <li>инструментальный обмер вагонов</li>
                    <li>расследование и разбор причин технологических неисправностей, рекламационных случаев, крушений, сходов</li>
                    <li>организация отстоя вагонов</li>
                </ul>
                <br>
                <br>
                <p>Ознакомиться со стоимостями и заказать услуги вы можете в на странице {!! link_to_route('trainCarService','Услуги по грузовым вагонам') !!}</p>
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
