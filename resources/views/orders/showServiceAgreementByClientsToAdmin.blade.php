@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <p>{!! link_to_route('admin', 'Вернуться в админку',null,['class'=>'btn btn-info']) !!}</p>
                <div class="panel panel-default">
                    <div class="panel-heading">Клиенты и договоры на оказание услуг</div>
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>
                    <div class="panel-body">
                    {!! Form::open(['action' => ['CreateDocumentsController@showServiceAgreementByClients'], 'role' => 'form', 'method'=>'GET']) !!}
                        <table width="100%">
                            <tr>
                                <td>
                                    <label for="filter">Фильтр по заказчику</label>
                                </td>
                                <td>
                                    <select id="filter" name="firm_id">
                                        <option value="0" {{ $firm_id ? null : 'selected' }}>Все</option>
                                        @foreach($firms as $firm)
                                            <option value="{{ $firm->id }}" {{ $firm->id == $firm_id ? 'selected' : null }}>{{ $firm->organisation_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    {!! Form::submit( 'Показать',['class'=>'btn btn-success']) !!}
                                </td>
                            </tr>
                        </table>
                    {!! Form::close() !!}
                    <hr>
                    @if(count($users))
                            <table width="100%" style="border-collapse: separate; border-spacing: 0 10px;">
                                <tr>
                                    <td style="border-bottom: 1px double black;">Клиент</td>
                                    <td style="border-bottom: 1px double black;">Договор заключен</td>
                                    <td style="border-bottom: 1px double black;">Загрузить договор,<br>полученный от клиента</td>
                                    <td style="border-bottom: 1px double black;"></td>
                                </tr>
                                @foreach($users as $user)
                                    <tr style="border-bottom: 1px solid black;">
                                        <td style="border-bottom: 1px solid black;">{{ $user->firm->organisation_name }}</td>
                                        <td style="border-bottom: 1px solid black;">{{ $user->firm->has_service_agreement ? 'ДА' : 'НЕТ' }}</td>
                                        <td style="border-bottom: 1px solid black;">
                                            @if( ! $user->firm->has_service_agreement)
                                                {!! Form::open(['action' => 'CreateDocumentsController@uploadServiceAgreementFromClient',
                                                  'enctype' => 'multipart/form-data', 'role' => 'form']) !!}
                                                {!! Form::hidden('firmId',$user->firm->id) !!}
                                                {!! Form::file('docFileName', ['class'=>'form-control', 'required'=>true]) !!}
                                                @if($errors->has('docFileName'))
                                                    <div class="alert-danger alert">{!! $errors->first('docFileName') !!}</div>
                                                @endif
                                                {!! Form::submit('Загрузить договор', ['class'=>'btn btn-success']) !!}

                                                {!! Form::close() !!}
                                            @endif
                                        </td>
                                        <td style="border-bottom: 1px solid black;">
                                            @if( ! $user->firm->has_service_agreement)
                                                {!! Form::open(['action' => ['CreateDocumentsController@createServiceAgreement'], 'role' => 'form']) !!}
                                                {!! Form::hidden('firmId',$user->firm->id) !!}
                                                {!! Form::submit( 'Заключить договор',['class'=>'btn btn-success']) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <div>Не найдено ни одного клиента</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop