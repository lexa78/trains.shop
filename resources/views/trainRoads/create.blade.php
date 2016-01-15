@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавление железной дороги</div>
                    <div class="panel-body">
                        @if(count($regions))
                            @include('trainRoads._form')
                        @else
                            <b>Не найдено ни одного региона, к которому можно привязать дорогу.</b><br>
                            {!! link_to_route('regions.create', 'Добавить регион', null, ['class'=>'btn btn-success']) !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection