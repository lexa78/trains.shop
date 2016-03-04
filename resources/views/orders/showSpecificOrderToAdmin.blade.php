@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>

                    <div class="panel-heading">Подробное рассмотрение заказа № <b class="orderID">{{ $order->id }}</b></div>
                    <div class="panel-body">
                        <h3>Заказ № {{ $order->id }}</h3>
                        <p>Дата и время оформления заказа: {{ \App\Models\Order::formatDate($order->created_at, true) }}</p>
                        <p>Заказчик: {{ $order->firm->organisation_name }}</p>
                        <p>Заказ в депо: {{ $order->products_in_order[0]->stantion_name }}</p>
                        <div class="answerOnChange"></div>
                        <p>
                            Статус заказа:
                            <select class="form-control statusChange">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ ($status->id == $order->status->id) ? 'selected' : null }}>{{ $status->status }}</option>
                                @endforeach
                            </select>
                            для изменения статуса заказа выберите нужный
                        </p>
                        <h4>Заказанные товары</h4>
                        <table width="100%">
                            <tr>
                                <td>№ п/п</td>
                                <td width="50%">Наименование товара</td>
                                <td>Цена</td>
                                <td>Количество</td>
                                <td>Сумма</td>
                            </tr>
                            <?
                                $totalSum = 0;
                                $tempSum = 0;
                            ?>
                            @foreach($order->products_in_order as $number => $product)
                                <tr>
                                    <td>{{ $number + 1 }}</td>
                                    <td  width="50%">{{ $product->product_name }}</td>
                                    <td>{{ $product->product_price }}</td>
                                    <td>{{ $product->product_amount }}</td>
                                    <td>{{ $tempSum = $product->product_price * $product->product_amount }}</td>
                                </tr>
                                <? $totalSum += $tempSum; ?>
                            @endforeach
                        </table>
                        <br>
                        <p>Сумма заказа: <b>{{ $totalSum }} руб.</b></p>
                        <br>

                        <div class="buttons_to_create {{ ($order->status->id == \App\Models\Order::COMPLETED) ? 'display_show' : 'display_none' }}">
                            {!! link_to_route('createDoc','Создать Торг-12',['order_id'=>$order->id, 'is_torg'=>1],['class'=>'btn btn-success']) !!}
                            {!! link_to_route('createDoc','Создать Счет-фактуру',['order_id'=>$order->id, 'is_torg'=>0],['class'=>'btn btn-success']) !!}
                        </div>

                        {!! link_to_route('showOrdersToAdmin','Вернуться к списку заказов') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('jsScripts')
    <script src="{{ asset('/js/statusChange.js') }}"></script>
@stop