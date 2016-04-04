<div class="row">
    {!! Form::open(['action' => ['MainPageController@update', $id], 'role' => 'form']) !!}
	{!! Form::hidden('_method', 'put') !!}

    <div class="form-group">
        <label>Основной текст</label>
        {!! Form::textArea('text', $text->text, ['class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('text'))
            <div class="alert-danger alert">{!! $errors->first('text') !!}</div>
        @endif
    </div>
    <div class="form-group">
        <label>Текст под картинкой "Запчасти"</label>
        {!! Form::textArea('l_p_text', $text->l_p_text, ['class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('l_p_text'))
            <div class="alert-danger alert">{!! $errors->first('l_p_text') !!}</div>
        @endif
    </div>
    <div class="form-group">
        <label>Текст под картинкой "Услуги"</label>
        {!! Form::textArea('r_p_text', $text->r_p_text, ['class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('r_p_text'))
            <div class="alert-danger alert">{!! $errors->first('r_p_text') !!}</div>
        @endif
    </div>

    {!! Form::submit( 'Изменить',['class'=>'btn btn-success']) !!}

    {!! Form::close() !!}
</div>
