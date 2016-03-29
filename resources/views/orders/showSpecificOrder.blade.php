@extends('public')

@section('content')

    <section id="content"><div class="ic"></div>
        <div class="sub-page">

            <div class="sub-page-left box-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="bigger">Заказ № {{ $order->id }}</h3>
                        <p>Дата и время оформления заказа: <strong>{{ \App\Models\Order::formatDate($order->created_at, true) }}</strong></p>
                        <p>Заказ в депо: <strong>{{ $order->products_in_order[0]->stantion_name }}</strong></p>
                        <p>Статус заказа: <strong>{{ $order->status->status }}</strong></p>
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
                                    <td align="right">{{ sprintf("%0.2f", $product->product_price) }}</td>
                                    <td align="center">{{ $product->product_amount }}</td>
                                    <td align="right">{{ sprintf("%0.2f", ($tempSum = $product->product_price * $product->product_amount)) }}</td>
                                </tr>
                                <? $totalSum += $tempSum; ?>
                            @endforeach
                        </table>
                        <p>Сумма заказа: <b>{{ sprintf("%0.2f", $totalSum) }} руб.</b></p>
                        @if(count($documents))
                            <h4>Документы</h4>
                            <table width="100%">
                                <tr>
                                    <td>Тип документа</td>
                                    <td>Загружен</td>
                                </tr>
                                <? $tempType = 0;?>
                                @foreach($documents as $document)
                                    <tr>
                                        @if($document->type != $tempType)
                                            <td>{{ \App\Models\Order::getDocTypeName($document->type, true) }}</td>
                                            <?
                                            $tempType = $document->type;
                                            ?>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>
                                            <?
                                            $shortFileName = explode(DIRECTORY_SEPARATOR, $document->file_name);
                                            $shortFileName = end($shortFileName);
                                            $tempFileName = explode('_', $shortFileName);
                                            $tempFileName = explode('.', end($tempFileName));
                                            $fileDate = date('d.m.Y', $tempFileName[0]);
                                            $shownFileName = \App\Models\Order::getDocTypeName($document->type, true).' №'.$document->order->id.'.'.$tempFileName[1];
                                            ?>
                                            {{ \App\Models\Order::getDocTypeName($document->type, true) }}, загруженный {{ $fileDate }}
                                            {!! Form::open(['route' => 'downloadDoc', 'role' => 'form', 'class'=>'inlineForm']) !!}
                                            {!! Form::hidden('shortFileName', $shortFileName) !!}
                                            {!! Form::hidden('shownFileName', $shownFileName) !!}
                                            {!! Form::hidden('download', true) !!}
                                            {!! Form::submit('Скачать', ['class'=>'button withWidth']) !!}
                                            {!! Form::close() !!}
                                            &nbsp;
                                            {!! Form::open(['route' => 'downloadDoc', 'role' => 'form', 'class'=>'inlineForm']) !!}
                                            {!! Form::hidden('shortFileName', $shortFileName) !!}
                                            {!! Form::hidden('shownFileName', $shownFileName) !!}
                                            {!! Form::hidden('download', false) !!}
                                            {!! Form::hidden('content', $tempFileName[1]) !!}
                                            {!! Form::submit('Посмотреть', ['class'=>'button-2 myBg withWidth']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                        {!! link_to_route('showMyOrders', 'Назад', null, ['class'=>'button']) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop