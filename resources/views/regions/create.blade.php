@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавление региона</div>
                    <div class="panel-body">
                        {{--<div class="flash-message">--}}
                            {{--@foreach (['danger', 'warning', 'success', 'info'] as $msg)--}}
                                {{--@if(Session::has('alert-' . $msg))--}}
                                    {{--<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</div>--}}
                        @include('regions._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection