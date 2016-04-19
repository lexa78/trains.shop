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

                    <div class="panel-heading">Загрузка договора оферты</div>
                    <div class="panel-body">
                        {!! Form::open(['action' => 'CreateDocumentsController@uploadOferta',
                            'enctype' => 'multipart/form-data', 'role' => 'form']) !!}

                        {{--{!! Form::file('docFileName', ['class'=>'form-control', 'required'=>true]) !!}--}}
                        <div class="fileform">
                            <div id="fileformlabel"></div>
                            <div class="selectbutton">Обзор</div>
                            <input id="upload" type="file" name="docFileName"  onchange="getName(this.value);" />
                        </div>
                        @if($errors->has('docFileName'))
                            <div class="alert-danger alert">{!! $errors->first('docFileName') !!}</div>
                        @endif
                        <br>
                        {!! Form::submit('Загрузить договор', ['class'=>'btn btn-success']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('jsScripts')
    <script>
        function getName (str){
            if (str.lastIndexOf('\\')){
                var i = str.lastIndexOf('\\')+1;
            }
            else{
                var i = str.lastIndexOf('/')+1;
            }
            var filename = str.slice(i);
            var uploaded = document.getElementById("fileformlabel");
            uploaded.innerHTML = filename;
        }
    </script>
@stop