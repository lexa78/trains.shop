@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! link_to_route('admin','Вернуться в админку', null, ['class'=>'btn btn-info']) !!}
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Регионы</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        @if(count($regions))
                        <table>
                            <tr>
                                <td>№ п/п</td>
                                <td>Название региона</td>
                                <td>Редактировать</td>
                                <td>Удалить</td>
                            </tr>
                            @foreach($regions as $key=>$region)
                                <tr>
                                    <td>{{  $key +1 }}</td>
                                    <td>{{$region->reg_name}}</td>
                                    <td>{!! link_to_route('regions.edit', 'Редактировать', $region->id, ['class'=>'btn btn-info']) !!}</td>
                                    <td>@include('regions._destroyForm')</td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                            <b>Таблица регионов не заполнена</b><br>
                        @endif
                            {!! link_to_route('regions.create', 'Добавить регион', null, ['class'=>'btn btn-success']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection