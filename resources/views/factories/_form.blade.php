<div class="row">
    @if($factory)
        {!! Form::open(['action' => ['FactoryController@update', $id], 'role' => 'form']) !!}
    @else
        {!! Form::open(['action' => 'FactoryController@store', 'role' => 'form']) !!}
    @endif
    @if($factory)
	{!! Form::hidden('_method', 'put') !!}
    @endif
    <div class="form-group">
        {!! Form::text('factory_code', $factoryCode, ['placeholder'=>'Код завода', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('factory_code'))
            <div class="alert-danger alert">{!! $errors->first('factory_code') !!}</div>
        @endif
    </div>
    <div class="form-group">
        {!! Form::text('factory_name', $factory, ['placeholder'=>'Название завода', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('factory_name'))
            <div class="alert-danger alert">{!! $errors->first('factory_name') !!}</div>
        @endif
    </div>
    {!! Form::submit( $factory ? 'Изменить' : 'Создать',['class'=>'btn btn-success']) !!}

    {!! Form::close() !!}
</div>
