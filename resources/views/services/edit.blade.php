@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактирование товара {{ $service->short_name }}</div>
                    <div class="panel-body">
                        @include('services._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection