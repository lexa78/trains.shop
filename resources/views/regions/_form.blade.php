<div class="row">
    @if($regName)
        {!! Form::open(['action' => ['RegionController@update', $id], 'role' => 'form']) !!}
    @else
        {!! Form::open(['action' => 'RegionController@store', 'role' => 'form']) !!}
    @endif
    @if($regName)
	{!! Form::hidden('_method', 'put') !!}
    @endif
    <div class="form-group">
        {!! Form::text('reg_name', $regName ? $regName :  old('reg_name'), ['placeholder'=>'Название региона', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('reg_name'))
            <div class="alert-danger alert">{!! $errors->first('reg_name') !!}</div>
        @endif
    </div>
    {!! Form::submit( $regName ? 'Изменить' : 'Создать',['class'=>'btn btn-success']) !!}

    {!! Form::close() !!}
</div>
