@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактирование шаблона счета</div>
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => ['CreateDocumentsController@updateInvoiceTemplate'], 'role' => 'form']) !!}
                        <div class="form-group">
                            {!! Form::textArea('template', $template, [
                                'placeholder'=>'Шаблон счета в формате html',
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