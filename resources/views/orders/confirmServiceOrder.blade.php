@extends('public')

@section('content')

    <section id="content"><div class="ic"></div>
        <div class="sub-page">

            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div>

            <div class="sub-page-left box-9">
                <h2 class="p4 cnt">Подтверждение заказа услуги "{{ $service->short_name }}"</h2>
                <p class="totalSum"><b>Компания - заказчик:</b> {{ $firm->organisation_name }}</p>
                <p class="totalSum"><b>Контактное лицо:</b> {{ $firm->contact_face_fio }}</p>
                <p class="totalSum"><b>Его телефон:</b> {{ $firm->phone }}</p>
                <hr>

                <p><b>Короткое название услуги:&nbsp;&nbsp;&nbsp;</b>{{ $service->short_name }}</p>
                <p><b>Полное название услуги:&nbsp;&nbsp;&nbsp;</b>{{ $service->full_name }}</p>
                <p><b>Единица измерения:&nbsp;&nbsp;&nbsp;</b>{{ $service->unit }}</p>
                <p><b>Срок исполнения:&nbsp;&nbsp;&nbsp;</b>{{ $service->period }}</p>
                <p><b>Требуемые документы:&nbsp;&nbsp;&nbsp;</b>{{ $service->documents }}</p>
                <p><b>Цена услуги:&nbsp;&nbsp;&nbsp;</b>{{ $service->price }} руб.</p>

                {!! Form::open(['action' => ['OrderController@storeServiceOrder'], 'role' => 'form']) !!}

                {!! Form::hidden('service_id', $service->id) !!}

                {!! Form::textArea('more_info', old('more_info'), ['placeholder'=>'Количество и номера вагонов, а также другая дополнительная информация', 'class'=>'form-control', 'required'=>true]) !!}
                @if($errors->has('more_info'))
                    <div class="alert-danger alert">{!! $errors->first('more_info') !!}</div>
                @endif

                @if($service->need_station)
                    {!! Form::hidden('need_station', $service->need_station) !!}
                    {!! Form::textArea('station_names', old('station_names'), ['placeholder'=>'Станция(и) нахождения вагонов', 'class'=>'form-control', 'required'=>true]) !!}
                    @if($errors->has('station_names'))
                        <div class="alert-danger alert">{!! $errors->first('station_names') !!}</div>
                    @endif
                @endif

                {!! Form::submit('Подтвердить заказ', ['class'=>'button-4']) !!}

                {!! Form::close() !!}

            </div>
        </div>
    </section>
@stop
