@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <p>{!! link_to_route('admin', 'Вернуться в админку',null,['class'=>'btn btn-info']) !!}</p>
                <div class="panel panel-default">
                    @if($newOnly)
                        <div class="panel-heading">Новые заказы запчастей</div>
                    @else
                        @if(isset($firm))
                            <div class="panel-heading">Заказы запчастей фирмы {{ $firm }}</div>
                        @else
                            <div class="panel-heading">Все заказы запчастей</div>
                        @endif
                    @endif
                    <div class="panel-body">
                        @if(count($orders))
                            @foreach($orders as $order)
                                <p>
                                    {!! link_to_route('showSpecificOrderToAdmin','Заказ № '
                                    .$order->id.' создан '.\App\Models\Order::formatDate($order->created_at)
                                    .' заказчик - '.$order->firm->organisation_name
                                    .' депо - '.$order->products_in_order[0]->stantion_name,
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