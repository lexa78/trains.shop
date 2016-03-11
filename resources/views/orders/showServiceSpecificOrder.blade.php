@extends('public')

@section('content')

    <section id="content"><div class="ic"></div>
        <div class="sub-page">

            <div class="sub-page-left box-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2>Заказ № {{ $order->id }}</h2>
                        <p>Дата и время оформления заказа: <strong>{{ \App\Models\Order::formatDate($order->created_at, true) }}</strong></p>
                        <p>Статус заказа: <strong>{{ $order->service_status->status }}</strong></p>
                        <br>
                        <h4>Заказанная услуга</h4>
                        <table width="100%">
                            <tr>
                                <td>Наименование</td>
                                <td>Цена</td>
                                <td>Номера вагонов</td>
                                @if($order->station_names)
                                    <td>Наименования станций</td>
                                @endif
                            </tr>
                                <tr>
                                    <td>{{ $order->service_name }}</td>
                                    <td>{{ $order->service_price }}</td>
                                    <td>{{ $order->more_info }}</td>
                                    @if($order->station_names)
                                        <td>{{ $order->station_names }}</td>
                                    @endif
                                </tr>
                        </table>
                        <br>
                        <p>Сумма заказа: <b>{{ $order->service_price }} руб.</b></p>
                        <br>
                        @if(count($documents))
                            <h2>Документы</h2>
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
                                            $shownFileName = \App\Models\Order::getDocTypeName($document->type, true).' №'.$document->service_order->id.'.'.$tempFileName[1];
                                            ?>
                                            {{ \App\Models\Order::getDocTypeName($document->type, true) }}, загруженный {{ $fileDate }}
                                            <br>
                                            {!! Form::open(['route' => 'downloadDoc', 'role' => 'form', 'class'=>'inlineForm']) !!}
                                            {!! Form::hidden('shortFileName', $shortFileName) !!}
                                            {!! Form::hidden('shownFileName', $shownFileName) !!}
                                            {!! Form::hidden('download', true) !!}
                                            {!! Form::submit('Скачать', ['class'=>'button']) !!}
                                            {!! Form::close() !!}
                                            &nbsp;
                                            {!! Form::open(['route' => 'downloadDoc', 'role' => 'form', 'class'=>'inlineForm']) !!}
                                            {!! Form::hidden('shortFileName', $shortFileName) !!}
                                            {!! Form::hidden('shownFileName', $shownFileName) !!}
                                            {!! Form::hidden('download', false) !!}
                                            {!! Form::hidden('content', $tempFileName[1]) !!}
                                            {!! Form::submit('Посмотреть', ['class'=>'button-2 myBg']) !!}
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