@extends('public')

@section('content')

    <section id="content"><div class="ic"></div>
        <div class="sub-page">

            <div class="sub-page-left box-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Заказ № {{ $order->id }}</h3>
                        <p>Дата и время оформления заказа: <strong>{{ \App\Models\Order::formatDate($order->created_at, true) }}</strong></p>
                        <p>Заказ в депо: <strong>{{ $order->products_in_order[0]->stantion->stantion_name }}</strong></p>
                        <p>Статус заказа: <strong>{{ $order->status->status }}</strong></p>
                        <br>
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
                        {{--<table>--}}
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--{!! Form::open(['route' => 'downloadDoc', 'role' => 'form']) !!}--}}

                                    {{--{!! Form::hidden('shortFileName', $shortFileName) !!}--}}
                                    {{--{!! Form::hidden('shownFileName', $shownFileName) !!}--}}
                                    {{--{!! Form::hidden('download', true) !!}--}}

                                    {{--{!! Form::submit('Скачать',['class'=>'button']) !!}--}}

                                    {{--{!! Form::close() !!}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--{!! Form::open(['route' => 'downloadDoc', 'role' => 'form']) !!}--}}

                                    {{--{!! Form::hidden('shortFileName', $shortFileName) !!}--}}
                                    {{--{!! Form::hidden('shownFileName', $shownFileName) !!}--}}
                                    {{--{!! Form::hidden('download', false) !!}--}}

                                    {{--{!! Form::submit('Посмотреть',['class'=>'button-2']) !!}--}}

                                    {{--{!! Form::close() !!}--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--</table>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop