@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавление группы товаров</div>
                    <div class="panel-body">
                        @include('categories._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection