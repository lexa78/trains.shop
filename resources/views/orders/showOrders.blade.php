@extends('public')

@section('content')
    <section id="content"><div class="ic"></div>
        <div class="sub-page">
            <div class="sub-page-left box-9">
                <h2 class="p5">Мои заказы</h2>
                <ul class="list-2">
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
    </section>
@stop