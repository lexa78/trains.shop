@extends('public')

@section('purchases_cart')
    <div class="purchases_cart">
        <div class="title-in-purchases_cart">Запчасти</div>
        {!! link_to_route('productCart','Заказано '.$productsCount.' запчастей') !!}
    </div>
@stop

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

            <div class="sub-page-left box-9">
                <h2 class="p4">Услуги по грузовым вагонам</h2>
                @if(! $userID)
                    <p class="alert alert-warning">Чтобы появилась возможность заказать услугу,
                        необходимо <a href="{{ url('/auth/login') }}">Войти</a> или
                        <a href="{{ url('/auth/register') }}">Зарегистрироваться</a>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
                @if(empty($services))
                    <h3>В данный момент мы не можем предоставить никакой услуги</h3>
                    <br><br>
                @else
                    <table>
                        <tr align="center" valign="middle">
                            <td width="50" align="center" valign="middle">№ п/п</td>
                            <td align="center" valign="middle">Короткое название</td>
                            <td align="center" valign="middle">Единица измерения</td>
                            <td align="center" valign="middle">Период</td>
                            <td align="center" valign="middle">Цена</td>
                            <td></td>
                        </tr>

                        @foreach($services as $key => $service)
                            <tr>
                                <td align="center" valign="middle">{{ $key + 1 }}</td>
                                <td align="center" valign="middle">{{ $service->short_name }}</td>
                                <td align="center" valign="middle">{{ $service->unit }}</td>
                                <td align="center" valign="middle">{{ $service->period }}</td>
                                <td align="center" valign="middle">{{ $service->price }}</td>
                                <td>
                                    <label class="button-3" for="modal-{{ $key + 1 }}">Подробно</label>
                                    @include('purchases._modal')
                                    @if($userID)
                                        {!! Form::open(['action' => ['OrderController@confirmServiceOrder', $service->id], 'role' => 'form']) !!}

                                        {!! Form::submit('Заказать', ['class'=>'button-4']) !!}

                                        {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
                {!! link_to_route('main', 'На главную', null, ['class'=>'button']) !!}
            </div>
        </div>
    </section>
@stop