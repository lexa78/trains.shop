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
                <img src="images/page1-img1.jpg" alt="">
                <p class="text-1">Schedule <strong>Services</strong></p>
                <p class="upper"><a href="http://blog.templatemonster.com/free-website-templates/" class="link" rel="nofollow" target="_blank">Click here</a> for more info about this free website templates  by TemplateMonster.com.</p>
                <a href="#" class="button">Read More</a>
            </div>
            <div>
                <img src="images/page1-img2.jpg" alt="">
                <p class="text-1">Preventive <strong>Maintenance</strong></p>
                <p class="upper">This website template is optimized for 1280X1024 screen res. It is also XHTML & CSS valid.</p>
                <a href="#" class="button">Read More</a>
            </div>
            <div>
                <img src="images/page1-img3.jpg" alt="">
                <p class="text-1">Repair <strong>Services</strong></p>
                <p class="upper">The PSD source files of this template are available for free for the registered members.</p>
                <a href="#" class="button">Read More</a>
            </div>
            <div class="last">
                <img src="images/page1-img4.jpg" alt="">
                <p class="text-1">Tire & Wheel <strong>Services</strong></p>
                <p class="upper">Feel free to get this free web template created  by Template Monster Team!</p>
                <a href="#" class="button">Read More</a>
            </div>
        </div>
        <div class="block-2 wrap pad-2">
            <div class="box-2">
                <h2 class="clr-1">Reviews</h2>
                <div class="comments">
                    <div>
                        “Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.”
                        <div class="comments-corner"></div>
                    </div>
                    <a href="#">dolor hendrerit</a>
                </div>
                <div class="comments">
                    <div>
                        “vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit.”
                        <div class="comments-corner"></div>
                    </div>
                    <a href="#">vulputate velit</a>
                </div>
            </div>
            <div class="box-3">
                <h2 class="clr-1">Our Services</h2>
                <div class="wrap">
                    <ul class="list-1">
                        <li><a href="#">Consetetur sadipscing</a></li>
                        <li><a href="#">elitr sed diam nonumy</a></li>
                        <li><a href="#">tempor invidunt utabore</a></li>
                        <li><a href="#">et dolore magna aliquyam</a></li>
                        <li><a href="#">erat sed diam voluptua</a></li>
                        <li><a href="#">At vero eos et accusam et</a></li>
                    </ul>
                    <ul class="list-1 last">
                        <li><a href="#">Takimata sanctus est</a></li>
                        <li><a href="#">Lorem ipsum dolor sit amet</a></li>
                        <li><a href="#">Ipsum dolor sit amet</a></li>
                        <li><a href="#">consetetur sadipscing </a></li>
                        <li><a href="#">sed diam nonumy eirmod</a></li>
                        <li><a href="#">tempor invidunt ut labore</a></li>
                    </ul>
                </div>
                <a href="#" class="button-2">Read More</a>
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
