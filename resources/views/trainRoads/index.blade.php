@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! link_to_route('admin','Вернуться в админку', null, ['class'=>'btn btn-info']) !!}
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Железные дороги</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        @if(count($tRoads))
                        <table>
                            <tr>
                                <td>№ п/п</td>
                                <td>Название железной дороги</td>
                                <td>Редактировать</td>
                                <td>Удалить</td>
                            </tr>
                            @foreach($tRoads as $key=>$tRoad)
                                <tr>
                                    <td>{{  $key +1 }}</td>
                                    <td>{!! link_to_route('trainRoads.show', $tRoad->tr_name, $tRoad->id) !!}</td>
                                    <td>{!! link_to_route('trainRoads.edit', 'Редактировать', $tRoad->id, ['class'=>'btn btn-info']) !!}</td>
                                    <td>@include('trainRoads._destroyForm')</td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                            <b>Таблица железных дорог не заполнена</b><br>
                        @endif
                            {!! link_to_route('trainRoads.create', 'Добавить железную дорогу', null, ['class'=>'btn btn-success']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection