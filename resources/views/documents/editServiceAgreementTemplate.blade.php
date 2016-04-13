@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактирование шаблона договора по дополнительным услугам</div>
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => ['CreateDocumentsController@updateServiceAgreementTemplate'], 'role' => 'form']) !!}
                        <div class="form-group">
                            {!! Form::textArea('template', $template, [
                                'placeholder'=>'Шаблон договора по прочим услугам в формате html',
                                'rows'=>25,
                                'class'=>'form-control', 'required'=>true]) !!}
                            @if($errors->has('template'))
                                <div class="alert-danger alert">{!! $errors->first('template') !!}</div>
                            @endif
                        </div>
                        {!! Form::submit( 'Изменить',['class'=>'btn btn-success']) !!}

                        {!! Form::close() !!}
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