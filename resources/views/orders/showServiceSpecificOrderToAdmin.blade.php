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
                        <div class="answerOnChange"></div>
                        <p>
                            Статус заказа:
                            <select class="form-control statusChange">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ ($status->id == $order->service_status->id) ? 'selected' : null }}>{{ $status->status }}</option>
                                @endforeach
                            </select>
                            для изменения статуса заказа выберите нужный
                        </p>
                        <h4>Заказанная услуга</h4>
                        <table width="100%">
                            <tr>
                                <td>Наименование</td>
                                <td>Цена</td>
                                <td>Количество и номера вагонов</td>
                                @if($order->station_names)
                                    <td>Названия станций нахождения вагонов</td>
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

                        <table>
                            <tr>
                                <td>Тип документа</td>
                                <td>Загружен</td>
                                <td>Отправлен</td>
                                <td>На отправку</td>
                            </tr>
                            @foreach($documents as $document)
                            @endforeach
                        </table>


                        <h4>Загрузить документ для этого заказа</h4>
                        {!! Form::open(['action' => 'CreateDocumentsController@uploadDocument',
                            'enctype' => 'multipart/form-data', 'role' => 'form']) !!}

                        {!! Form::hidden('order_id', $order->id) !!}

                        {!! Form::hidden('document_for', \App\Models\Order::DOCUMENT_FOR_SERVICE) !!}

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
                        {!! link_to_route('showServiceOrdersToAdmin','Вернуться к списку заказов') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('jsScripts')
    <script src="{{ asset('/js/statusChange.js') }}"></script>
@stop