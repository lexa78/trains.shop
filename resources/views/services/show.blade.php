@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    {!! link_to_route('services.index','Назад', null, ['class'=>'btn btn-info']) !!}
                    <div class="panel-heading">Подробное описание услуги {{$service->short_name}}</div>
                    <div class="panel-body">
                        <p><b>Короткое название:&nbsp;</b>{{ $service->short_name }}</p>
                        <p><b>Полное название:&nbsp;</b>{{ $service->full_name }}</p>
                        <p><b>Единица измерения:&nbsp;</b>{{ $service->unit }}</p>
                        <p><b>Срок исполнения:&nbsp;</b>{{ $service->period }}</p>
                        <p><b>Требуемые документы:&nbsp;</b>{{ $service->documents }}</p>
                        <p><b>Цена:&nbsp;</b>{{ $service->price }} руб.</p>
                        <p><b>Для этой услуги нужно указывать станцию:&nbsp;</b>{{ $service->need_station ? 'да' : 'нет' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection