@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <p>{!! link_to_route('admin', 'Вернуться в админку',null,['class'=>'btn btn-info']) !!}</p>
                <div class="panel panel-default">
                    @if($newOnly)
                        <div class="panel-heading">Новые заказы услуг</div>
                    @else
                        @if(isset($firm))
                            <div class="panel-heading">Заказы услуг фирмы {{ $firm }}</div>
                        @else
                            <div class="panel-heading">Все заказы услуг</div>
                        @endif
                    @endif
                    <div class="panel-body">
                        @if(count($orders))
                            @foreach($orders as $order)
                                <p>
                                    {!! link_to_route('showServiceSpecificOrderToAdmin','Заказ № '
                                    .$order->id.' создан '.\App\Models\Order::formatDate($order->created_at)
                                    .' заказчик - '.$order->firm->organisation_name,
                                     ['order_id'=>$order->id]) !!}
                                </p>
                            @endforeach
                        @else
                            <div>Заказов не было</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop