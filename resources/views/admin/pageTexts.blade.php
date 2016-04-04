@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Тексты на страницах</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        <ul>
                            <li>{!! link_to_route('main_page_text.edit','Изменить текст на Главной странице', ['id' => 1]) !!}</li>
                            <li>{!! link_to_route('contact_page_text.edit','Изменить текст на странице "Контакты"', ['id' => 1]) !!}</li>
                            <li>{!! link_to_route('about_page_text.edit','Изменить текст на странице "О компании"', ['id' => 1]) !!}</li>
                            <li>{!! link_to_route('for_provider_text.edit','Изменить текст на странице "Для поставщиков"', ['id' => 1]) !!}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection