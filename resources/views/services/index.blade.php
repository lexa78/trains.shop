@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! link_to_route('admin','Вернуться в админку', null, ['class'=>'btn btn-info']) !!}
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Услуги</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        @if(count($services))
                        <table>
                            <tr>
                                <td>№ п/п</td>
                                <td>Короткое название</td>
                                <td>Полное название</td>
                                <td>Единица измерения</td>
                                <td>Период</td>
                                <td>Документы, которые нужно предоставить</td>
                                <td>Редактировать</td>
                                <td>Удалить</td>
                            </tr>
                            @foreach($services as $key=>$service)
                                <tr>
                                    <td>{{  $key +1 }}</td>
                                    <td>{!! link_to_route('services.show', $service->short_name, $service->id) !!}</td>
                                    <td>{{ $service->full_name }}</td>
                                    <td>{{ $service->unit }}</td>
                                    <td>{{ $service->period }}</td>
                                    <td>{{ $service->documents }}</td>
                                    <td>{!! link_to_route('services.edit', 'Редактировать', $service->id, ['class'=>'btn btn-info']) !!}</td>
                                    <td>@include('services._destroyForm')</td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                            <b>Таблица услуг не заполнена</b><br>
                        @endif
                            {!! link_to_route('services.create', 'Добавить услугу', null, ['class'=>'btn btn-success']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection