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

            <div class="sub-page-left box-9">
                <h2 class="p4 cnt">Подтверждение заказа</h2>
                <p class="totalSum"><b>Компания - заказчик:</b> {{ $firm->organisation_name }}</p>
                <p class="totalSum"><b>Контактное лицо:</b> {{ $firm->contact_face_fio }}</p>
                <p class="totalSum"><b>Его телефон:</b> {{ $firm->phone }}</p>
                <hr>
                <table width="100%">
                    <tr>
                        <td>№ п/п</td>
                        <td>Название товара</td>
                        <td>Цена</td>
                        <td>Количество</td>
                        <td>Сумма</td>
                    </tr>
                    <? $totalSum = 0; ?>
                    @foreach($products as $stKey=>$stationsArr)
                        <tr align="center"><td colspan="5"><hr><b>Заказанные товары в депо {{$stKey}}</b><hr></td></tr>
                        <?
                        $sumInDepo = 0;
                        $totalSumInDepo = 0;
                        ?>
                        @foreach($stationsArr as $key=>$item)
                            <tr>
                                <td>{{  $key +1 }}</td>
                                <td>{{$item['product_name']}}</td>
                                <td>{{$item['product_price']}} руб.</td>
                                <td>{{$item['product_amount']}}</td>
                                <td>{{ $sumInDepo = $item['product_price'] * $item['product_amount'] }} руб.</td>
                            </tr>
                            <? $totalSumInDepo += $sumInDepo;?>
                        @endforeach
                        <tr align="right"><td colspan="5"><b>Сумма по депо {{ $totalSumInDepo }} руб.</b></td></tr>
                        <? $totalSum += $totalSumInDepo; ?>
                    @endforeach
                </table>
                <p class="totalSum">Итого на сумму <b>{{ $totalSum }}</b> руб.</p>
                <br>
                {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/store_order') }}">--}}
                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                {!! Form::open(['action' => 'OrderController@store', 'role' => 'form']) !!}
                <div class="form-group">
                    <label class="totalSum" for="oferta">Нажимая кнопку "Подтвердить", я принимаю условия <a href="/showOferta" target="_blank">Договора оферты</a></label>
                    <input type="checkbox" class="qwe" name="oferta" id="oferta">
                    <div class="col-md-6">
                        @if($errors->has('oferta'))
                            <div class="alert-danger alert">{!! $errors->first('oferta') !!}</div>
                        @endif
                    </div>
                </div>

                <input type="hidden" name="userID" value="{{ Auth::user()->id }}">
                @if($errors->has('userID'))
                    <div class="alert-danger alert">{!! $errors->first('userID') !!}</div>
                @endif
                {{--<div class="form-group">--}}
                {{--<div class="col-md-6 col-md-offset-4">--}}
                {{--<button type="submit" class="btn btn-success">--}}
                {{--Подтвердить--}}
                {{--</button>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</form>--}}
                <div class="gasket"></div>
                {!! Form::submit('Подтвердить', ['class'=>'button float-l']) !!}
                {!! Form::close() !!}

                {{--{!! link_to_route('storeOrder','Подтвердить', ['userID'=>$userID], ['class'=>'btn btn-success']) !!}--}}
                {!! link_to_route('productCart','Вернуться в корзину', null, ['class'=>'button-2 float-r']) !!}
            </div>
        </div>
    </section>
@stop
