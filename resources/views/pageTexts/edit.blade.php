@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>

                    @if($page == 'О компании')
                        <div class="panel-heading">Добавление изображений на страницу "О компании"</div>
                        <div class="panel-body">
                            {!! Form::open(['action' => 'AboutPageController@uploadImage',
                            'enctype' => 'multipart/form-data', 'role' => 'form']) !!}

                            {!! Form::file('imgFileName', ['class'=>'form-control', 'required'=>true]) !!}
                            @if($errors->has('imgFileName'))
                                <div class="alert-danger alert">{!! $errors->first('imgFileName') !!}</div>
                            @endif
                            <br>
                            {!! Form::submit('Загрузить картинку', ['class'=>'btn btn-success']) !!}

                            {!! Form::close() !!}

                        </div>
                        <br>
                    @endif
                    <div class="panel-heading">Редактирование текста на странице {{ $page }}</div>
                    <div class="panel-body">
                        @if($page == 'Главная')
                            @include('pageTexts._mainForm')
                        @else
                            @include('pageTexts._form')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('jsScripts')
    <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            content_css : "/css/tinyMce_content.css",
            language : "ru",
            selector : "textarea",
            plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
            toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>
@stop