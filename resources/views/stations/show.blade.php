@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    {!! link_to_route('stations.index','Назад', null, ['class'=>'btn btn-info']) !!}
                    <div class="panel-heading">Подробное описание депо {{$station->stantion_name}}</div>
                    <div class="panel-body">
                        <table border="1" cellpadding="5" cellspacing="10">
                            <tr>
                                <td>Название:</td>
                                <td>{{ $station->stantion_name }}</td>
                            </tr>
                            <tr>
                                <td>Находится на:</td>
                                <td>{{ $tRoadName }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection