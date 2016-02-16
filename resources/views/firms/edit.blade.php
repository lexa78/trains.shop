@extends('public')

@section('content')
    <section id="content"><div class="ic"></div>
        <div class="sub-page">
            <div class="sub-page-left box-9">
                <h2 class="p5">Редактирование информации о фирме {{ $firm->organisation_name }}</h2>
                @include('firms._form')
            </div>
            <div class="sub-page-right">
                <div class="shadow box-8 bot-2">
                    <h2 class="p2">Warranty</h2>
                    <p class="text-3 p2">Lorem ipsum dolor</p>
                    <p class="upper">Aenean nec eros. Vestibulum ante ipsum primiss in faucibus orci luctus et ultrices posu ere cubilia Curae; Suspendisse sollicitudin:</p>
                    <img src="images/page4-img3.jpg" alt="">
                    <ul class="list-1">
                        <li><a href="#">Proin ullamcorper urna</a></li>
                        <li><a href="#">Aenean auctor wisi et urna</a></li>
                        <li><a href="#">Integer rutrum ante eu</a></li>
                        <li><a href="#">Mauris accumsan nulla</a></li>
                        <li><a href="#">Proin ullamcorper urna</a></li>
                        <li><a href="#">Aenean auctor wisi et urna</a></li>
                    </ul>
                </div>
                <h2 class="p3">Suspension</h2>
                <p class="upper">Fusce suscipit varius mi. Cum sociis natoque penatibus et ma dis parturient montes, nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc.</p>
                <a href="#" class="button-2 top-4">Read More</a>
            </div>
        </div>
    </section>
@endsection