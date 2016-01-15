@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Покупки</div>

                    <div class="panel-body">
                        <ul>
                            <li>{!! link_to_route('trainCar','Детали товарных вагонов') !!}</li>
                            <li>{!! link_to_route('trainCarService','Услуги по грузовым вагонам') !!}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection