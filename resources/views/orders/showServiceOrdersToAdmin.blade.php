@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    @if($newOnly)
                        <div class="panel-heading">Новые заказы услуг</div>
                    @else
                        <div class="panel-heading">Все заказы услуг</div>
                    @endif
                    <div class="panel-body">
                        @foreach($orders as $order)
                            <p>
                                {!! link_to_route('showServiceSpecificOrderToAdmin','Заказ № '
                                .$order->id.' создан '.\App\Models\Order::formatDate($order->created_at)
                                .' заказчик - '.$order->firm->organisation_name,
                                 ['order_id'=>$order->id]) !!}
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop