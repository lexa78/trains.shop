@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! link_to_route('admin','Вернуться в админку', null, ['class'=>'btn btn-info']) !!}
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Статусы заказа услуг</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        @if(count($statuses))
                        <table width="100%">
                            <tr>
                                <td>№ п/п</td>
                                <td>Статус заказа услуг</td>
                                <td>Начальный статус</td>
                                <td>Редактировать</td>
                                <td>Удалить</td>
                            </tr>
                            @foreach($statuses as $key=>$status)
                                <tr>
                                    <td>{{  $key +1 }}</td>
                                    <td>{{$status->status}}</td>
                                    <td>{{$status->is_first ? 'Да' : 'Нет'}}</td>
                                    <td>{!! link_to_route('service_statuses.edit', 'Редактировать', $status->id, ['class'=>'btn btn-info']) !!}</td>
                                    <td>@include('serviceStatuses._destroyForm')</td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                            <b>Таблица статусов заказа услуг не заполнена</b><br>
                        @endif
                            {!! link_to_route('service_statuses.create', 'Добавить статус', null, ['class'=>'btn btn-success']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop