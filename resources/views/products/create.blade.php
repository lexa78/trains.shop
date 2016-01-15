@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавление товара</div>
                    <div class="panel-body">
                        @include('products._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsScripts')
    <script src="{{ asset('/js/priceForAll.js') }}"></script>
@stop