@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    {!! link_to_route('trainRoads.index','Назад', null, ['class'=>'btn btn-info']) !!}
                    <div class="panel-heading">Подробное описание железной дороги {{$tRoad->tr_name}}</div>
                    <div class="panel-body">
                        <table border="1" cellpadding="5" cellspacing="10">
                            <tr>
                                <td>Название:</td>
                                <td>{{ $tRoad->tr_name }}</td>
                            </tr>
                            <tr>
                                <td>Относится к:</td>
                                <td>{{ $regionName }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection