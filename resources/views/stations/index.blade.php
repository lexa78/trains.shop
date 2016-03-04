@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! link_to_route('admin','Вернуться в админку', null, ['class'=>'btn btn-info']) !!}
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Депо</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        @if(count($stations))
                        <table width="100%">
                            <tr>
                                <td>№ п/п</td>
                                <td>Название депо</td>
                                <td>Редактировать</td>
                                <td>Удалить</td>
                            </tr>
                            @foreach($stations as $key=>$station)
                                <tr>
                                    <td>{{  $key +1 }}</td>
                                    <td>{!! link_to_route('stations.show', $station->stantion_name, $station->id) !!}</td>
                                    <td>{!! link_to_route('stations.edit', 'Редактировать', $station->id, ['class'=>'btn btn-info']) !!}</td>
                                    <td>@include('stations._destroyForm')</td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                            <b>Таблица станций не заполнена</b><br>
                        @endif
                            {!! link_to_route('stations.create', 'Добавить депо', null, ['class'=>'btn btn-success']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection