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
                        @if($order->firm->has_service_agreement)
                            <p>Договор заключен</p>
                            {!! link_to_route('showServiceAgreementWithClient','Посмотреть договор',['id'=>$serviceAgreement->id],['class'=>'btn btn-warning', 'target'=>'_blank']) !!}
                        @else
                            <p>
                                @if($serviceAgreement)
                                    @if($serviceAgreement->sended)
                                        Договор пока не заключен. Отправлен на подпись клиенту по email.  Ждем ответного письма. <span style="color: red">ВНИМАНИЕ!!! При повторном нажатии кнопки "Сгенерировать договор и отправить", прежний договор, отправленный клиенту, будет удален. Его место займет вновь сформированный договор.</span>
                                        {!! link_to_route('showServiceAgreementWithClient','Посмотреть отправленный договор',['id'=>$serviceAgreement->id],['class'=>'btn btn-warning', 'target'=>'_blank']) !!}
                                    @else
                                        Договор не заключен и не отправлен на подпись клиенту.
                                    @endif
                                    {{--{{ $serviceAgreement->sended ? 'Договор пока не заключен. Отправлен на подпись клиенту по email.  Ждем ответного письма. ВНИМАНИЕ!!! При повторном нажатии кнопки ниже, прежний договор, отправленный клиенту, будет удален. Его место займет вновь сформированный договор.' : 'Договор не заключен и не отправлен на подпись клиенту.' }}--}}
                                @else
                                    Договор не заключен и не отправлен на подпись клиенту.
                                @endif
                                {!! Form::open(['route' => ['checkGenitiveCase', $order->firm->id, $order->id], 'role' => 'form', 'class'=>'inlineForm']) !!}
                                {!! Form::submit('Сгенерировать договор и отправить', ['class'=>'btn btn-success']) !!}
                                {!! Form::close() !!}
                            </p>
                        @endif
                        <p></p>
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
                                            $shownFileName = \App\Models\Order::getDocTypeName($document->type, true).' №'.$document->service_order->id.'.'.$tempFileName[1];
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
                        <input type="button" class="btn btn-info btnSendChecked" value="Отправить выбранные документы">
                        <div>
                            <p class="alert alert-success success hidden">Документы отправлены заказчику.. <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            <p class="alert alert-danger danger hidden">Ошибка отправки документов. <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        </div>
                        <br><br><br>

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
                                {{--<option value="{{ \App\Models\Order::CONTRACT_TYPE }}">{{ \App\Models\Order::getDocTypeName(\App\Models\Order::CONTRACT_TYPE, true) }}</option>--}}
                                {{--<option value="{{ \App\Models\Order::SUPPLEMENTARY_AGREEMENT_TYPE }}">{{ \App\Models\Order::getDocTypeName(\App\Models\Order::SUPPLEMENTARY_AGREEMENT_TYPE, true) }}</option>--}}
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
    <script src="{{ asset('/js/serviceStatusChange.js') }}"></script>
    <script src="{{ asset('/js/checkboxesForSend.js') }}"></script>
@stop