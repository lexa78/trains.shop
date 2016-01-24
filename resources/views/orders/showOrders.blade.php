@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Мои заказы</div>
                    <div class="panel-body">
                        <ul>
                            @foreach($orders as $order)
                                <li> @if($order->is_new)<b>@endif
                                    {!! link_to_route('showSpecificOrder','Заказ № '
                                    .$order->id.' от '.\App\Models\Order::formatDate($order->created_at)
                                    .' депо - '.$order->products_in_order[0]->stantion->stantion_name
                                    .' статус - '.$order->status->status,['order_id'=>$order->id, 'user_id'=>Auth::user()->id]) !!}
                                    @if($order->is_new)</b>@endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop