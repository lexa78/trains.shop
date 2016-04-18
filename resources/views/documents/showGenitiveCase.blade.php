@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <p><b>Прежде, чем начнется формирование договора, проверьте правильность склонения должности, ФИО и документа. При необходимости, внесите корректировки.</b></p>
                    {!! Form::open(['action' => ['CreateDocumentsController@createServiceAgreementTemplateAndSend', 'firm_id'=>$firm_id, 'order_id'=>$orderId], 'role' => 'form']) !!}
                    <div class="form-group">
                        <label class="col-md-4 control-label">...в лице (должность)</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="rp_face_position" value="{{ $position }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">...в лице (ФИО)</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="rp_face_fio" value="{{ $fio }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">...действующего на основании</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="rp_base_document" value="{{ $document }}">
                        </div>
                    </div>
                    {!! Form::submit( 'Сгенерировать договор и отправить',['class'=>'btn btn-success']) !!}

                    {!! Form::close() !!}
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