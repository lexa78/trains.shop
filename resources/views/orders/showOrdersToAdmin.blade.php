@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Новые заказы</div>
                    <div class="panel-body">
                        @foreach($orders as $order)
                            <p>
                                {!! link_to_route('showSpecificOrderToAdmin','Заказ № '
                                .$order->id.' создан '.\App\Models\Order::formatDate($order->created_at)
                                .' заказчик - '.$order->firm->organisation_name
                                .' депо - '.$order->products_in_order[0]->stantion_name,
                                 ['order_id'=>$order->id]) !!}
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop