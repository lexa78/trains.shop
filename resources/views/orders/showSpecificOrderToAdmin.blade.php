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
                        <hr><hr>
                        {{--<div class="buttons_to_create {{ ($order->status->id == \App\Models\Order::COMPLETED) ? 'display_show' : 'display_none' }}">--}}
                            {{--{!! link_to_route('createDoc','Создать Торг-12',['order_id'=>$order->id, 'is_torg'=>1],['class'=>'btn btn-success']) !!}--}}
                            {{--{!! link_to_route('createDoc','Создать Счет-фактуру',['order_id'=>$order->id, 'is_torg'=>0],['class'=>'btn btn-success']) !!}--}}
                        {{--</div>--}}

                        <table width="100%">
                            <tr>
                                <td>Тип документа</td>
                                <td>Загружен</td>
                                <td>Отправлен</td>
                                <td>На отправку</td>
                            </tr>
                            <? $tempType = 0;?>
                            @foreach($documents as $document)
                                <tr>
                                    @if($document->type != $tempType)
                                        <td>{{ \App\Models\Order::getDocTypeName($document->type, true) }}</td>
                                        <?
                                        $tempType = $document->type;
                                        unset($documentTypes[$document->type]);
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
                                        <br>
                                        {!! Form::open(['route' => 'downloadDoc', 'role' => 'form', 'class'=>'inlineForm']) !!}
                                        {!! Form::hidden('shortFileName', $shortFileName) !!}
                                        {!! Form::hidden('shownFileName', $shownFileName) !!}
                                        {!! Form::hidden('download', true) !!}
                                        {!! Form::submit('Скачать', ['class'=>'btn btn-success']) !!}
                                        {!! Form::close() !!}
                                        &nbsp;
                                        {!! Form::open(['route' => 'downloadDoc', 'role' => 'form', 'class'=>'inlineForm']) !!}
                                        {!! Form::hidden('shortFileName', $shortFileName) !!}
                                        {!! Form::hidden('shownFileName', $shownFileName) !!}
                                        {!! Form::hidden('download', false) !!}
                                        {!! Form::hidden('content', $tempFileName[1]) !!}
                                        {!! Form::submit('Посмотреть', ['class'=>'btn btn-success']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>{{ $document->sended ? 'Да' : 'Нет'}}</td>
                                    <td>{!! $document->sended ? null : Form::checkbox('forSend_'.$document->id, $document->id, null, ['class'=>'forSend']) !!}</td>
                                </tr>
                            @endforeach
                            @foreach($documentTypes as $documentType)
                                <tr>
                                    <td>{{ \App\Models\Order::getDocTypeName($documentType, true) }}</td>
                                    <td>Нет</td>
                                    <td>Нет</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </table>
                        <br>
                        <input type="button" class="btn btn-info btnSendChecked" value="Отправить выбранные документы">
                        <div>
                            <p class="alert alert-success success hidden">Документы отправлены заказчику.. <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            <p class="alert alert-danger danger hidden">Ошибка отправки документов. <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        </div>
                        <br><br>
                        <hr><hr>
                        <h4>Загрузить документ для этого заказа</h4>
                        {!! Form::open(['action' => 'CreateDocumentsController@uploadDocument',
                            'enctype' => 'multipart/form-data', 'role' => 'form']) !!}

                        {!! Form::hidden('order_id', $order->id) !!}

                        {!! Form::hidden('document_for', \App\Models\Order::DOCUMENT_FOR_SPARE_PART) !!}

                        <p>
                            <label for="docType">Тип документа:</label>
                            <select name="docType" class="form-control" id="docType">
                                <option value="{{ \App\Models\Order::INVOICE_TYPE }}">{{ \App\Models\Order::getDocTypeName(\App\Models\Order::INVOICE_TYPE, true) }}</option>
                                <option value="{{ \App\Models\Order::INVOICE_ACCT_TYPE }}">{{ \App\Models\Order::getDocTypeName(\App\Models\Order::INVOICE_ACCT_TYPE, true) }}</option>
                                <option value="{{ \App\Models\Order::AUCTION_12_TYPE }}">{{ \App\Models\Order::getDocTypeName(\App\Models\Order::AUCTION_12_TYPE, true) }}</option>
                                <option value="{{ \App\Models\Order::CONTRACT_TYPE }}">{{ \App\Models\Order::getDocTypeName(\App\Models\Order::CONTRACT_TYPE, true) }}</option>
                                <option value="{{ \App\Models\Order::SUPPLEMENTARY_AGREEMENT_TYPE }}">{{ \App\Models\Order::getDocTypeName(\App\Models\Order::SUPPLEMENTARY_AGREEMENT_TYPE, true) }}</option>
                            </select>
                        </p>

                        {!! Form::file('docFileName', ['class'=>'form-control', 'required'=>true]) !!}
                        @if($errors->has('docFileName'))
                            <div class="alert-danger alert">{!! $errors->first('docFileName') !!}</div>
                        @endif

                        {!! Form::submit('Загрузить документ', ['class'=>'btn btn-success']) !!}

                        {!! Form::close() !!}
                        <br>

                        {!! link_to_route('showOrdersToAdmin','Вернуться к списку заказов') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('jsScripts')
    <script src="{{ asset('/js/statusChange.js') }}"></script>
    <script src="{{ asset('/js/checkboxesForSend.js') }}"></script>
@stop