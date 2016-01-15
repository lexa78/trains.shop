@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавление депо</div>
                    <div class="panel-body">
                        @if(count($trainRoads))
                            @include('stations._form')
                        @else
                            <b>Не найдено ни одной железной дороги, к которой можно привязать депо.</b><br>
                            {!! link_to_route('trainRoads.create', 'Добавить железную дорогу', null, ['class'=>'btn btn-success']) !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection