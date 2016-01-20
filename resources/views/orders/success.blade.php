@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Заказ № {{ $orderNumber }} оформлен!</div>

                    <div class="panel-body">
                        <h2>Спасибо за заказ!</h2>
                        <p>Теперь вам нужно оплатить счет</p>
                        <p>Если счет не будет оплачен через ?????? дней, он автоматически анулируется</p>
                        @foreach($deposArr as $depo)
                            <p>{!! link_to_route('invoice','Скачать счет по депо '.$depo,['orderNumber'=>$orderNumber, 'depoName'=>$depo, 'look'=>0],['target'=>'_blank']) !!}</p>
                            <p>{!! link_to_route('invoice','Посмотреть счет по депо '.$depo,['orderNumber'=>$orderNumber, 'depoName'=>$depo, 'look'=>1],['target'=>'_blank']) !!}</p>
                            <hr>
                        @endforeach
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
