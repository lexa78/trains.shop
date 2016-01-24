@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Личный кабинет</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>

                        <ul>
                            <li><a href="{{ route('firm.edit') }}">Редактировать информацию о фирме {{ $firmName }}</a></li>
                            <li><a href="{{ route('showMyOrders') }}">Мои заказы (всего {{ $countOfOrders }})</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
