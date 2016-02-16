@extends('public')

@section('content')
    <section id="content"><div class="ic"></div>
        <div class="sub-page">
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div>

            <div class="sub-page-left">
                <h2 class="p4">Личный кабинет представителя фирмы {{ $firmName }}</h2>
                <div class="box-6 top-2">
                    <div class="extra-wrap">
                        <ul class="text-2">
                            <li><a href="{{ route('firm.edit') }}" class="link">Редактировать информацию о фирме {{ $firmName }}</a></li>
                            <li><a href="{{ route('showMyOrders') }}" class="link">Мои заказы (всего {{ $countOfOrders }})</a></li>
                            <li><a href="{{ route('showMyDocs') }}" class="link">Мои документы (всего {{ $countOfDocuments }})</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="sub-page-right">
                <div class="shadow box-7 bot-2">
                    <h2 class="p2">Maintenance</h2>
                    <p class="text-3 p2">It’S IMPORTANT</p>
                    <p class="upper">Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>
                    <img src="images/page3-img5.jpg" alt="">
                    <p class="upper">Vestibulum ante ipsum primis in faucibus orci luctus:</p>
                    <ul class="list-1">
                        <li><a href="#">Oil Change</a></li>
                        <li><a href="#">Maintenance Tune-Up</a></li>
                        <li><a href="#">Transmission Service</a></li>
                        <li><a href="#">A/C Service</a></li>
                        <li><a href="#">Radiator Service</a></li>
                    </ul>
                </div>
                <h2 class="p2">Guarantee</h2>
                <p class="text-3 upper p2">Aenean nec eros</p>
                <p class="upper">Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis.</p>
                <a href="#" class="button-2 top-3">Read More</a>
            </div>
        </div>
    </section>
@stop
