<div class="row">
    <?
        switch($page) {
            case 'Контакты':
    ?>
                {!! Form::open(['action' => ['ContactPageController@update', $id], 'role' => 'form']) !!}
    <?
            break;
            case 'Для поставщиков':
    ?>
                {!! Form::open(['action' => ['ProviderPageController@update', $id], 'role' => 'form']) !!}
    <?
                break;
            case 'О компании':
    ?>
                {!! Form::open(['action' => ['AboutPageController@update', $id], 'role' => 'form']) !!}
    <?
                break;
        }
    ?>
	{!! Form::hidden('_method', 'put') !!}

    <div class="form-group">
        {!! Form::textArea('text', $text->text, ['class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('text'))
            <div class="alert-danger alert">{!! $errors->first('text') !!}</div>
        @endif
    </div>

    {!! Form::submit( 'Изменить',['class'=>'btn btn-success']) !!}

    {!! Form::close() !!}
</div>
