@extends('public')

@section('content')
    <section id="content"><div class="ic"></div>
        <div class="sub-page">
            <div class="sub-page-left box-9">
                <h2 class="p5">Мои заказы</h2>
                <table>
                    <tr>
                        <td align="center"><h3 class="p5">Заказы запчастей</h3></td>
                        <td align="center"><h3 class="p5">Заказы услуг</h3></td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <ul class="list-2">
                                @foreach($orders as $order)
                                    <li> @if($order->is_new)<b>@endif
                                            {!! link_to_route('showSpecificOrder','Заказ № '
                                            .$order->id.' от '.\App\Models\Order::formatDate($order->created_at)
                                            .' депо - '.$order->products_in_order[0]->stantion_name
                                            .' статус - '.$order->status->status,['order_id'=>$order->id,
                                            'user_id'=>Auth::user()->id,
                                            'order_type'=>\App\Models\Order::DOCUMENT_FOR_SPARE_PART]) !!}
                                            @if($order->is_new)</b>@endif
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td width="50%">
                            <ul class="list-2">
                                @foreach($serviceOrders as $order)
                                    <li> @if($order->is_new)<b>@endif
                                            {!! link_to_route('showSpecificOrder','Заказ № '
                                            .$order->id.' от '.\App\Models\Order::formatDate($order->created_at)
                                            .' статус - '.$order->service_status->status,['order_id'=>$order->id,
                                            'user_id'=>Auth::user()->id,
                                            'order_type'=>\App\Models\Order::DOCUMENT_FOR_SERVICE]) !!}
                                            @if($order->is_new)</b>@endif
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
@stop