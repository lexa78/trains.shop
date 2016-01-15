@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Подтверждение заказа</div>

                    <div class="panel-body">
                        <h2>Подтверждение заказа № {{ $nextOrderId }}</h2>
                        <p><b>Компания - заказчик:</b> {{ $firm->organisation_name }}</p>
                        <p><b>Контактное лицо:</b> {{ $firm->contact_face_fio }}</p>
                        <p><b>Его телефон:</b> {{ $firm->phone }}</p>
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
                        {!! link_to_route('storeOrder','Подтвердить', ['userID'=>$userID], ['class'=>'btn btn-success']) !!}
                        {!! link_to_route('productCart','Вернуться в корзину', null, ['class'=>'btn btn-info']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
