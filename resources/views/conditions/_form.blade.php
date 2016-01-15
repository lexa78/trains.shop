<div class="row">
    @if($cond)
        {!! Form::open(['action' => ['ConditionController@update', $id], 'role' => 'form']) !!}
    @else
        {!! Form::open(['action' => 'ConditionController@store', 'role' => 'form']) !!}
    @endif
    @if($cond)
	{!! Form::hidden('_method', 'put') !!}
    @endif
    <div class="form-group">
        {!! Form::text('condition', $cond, ['placeholder'=>'Состояние', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('condition'))
            <div class="alert-danger alert">{!! $errors->first('condition') !!}</div>
        @endif
    </div>
    {!! Form::submit( $cond ? 'Изменить' : 'Создать',['class'=>'btn btn-success']) !!}

    {!! Form::close() !!}
</div>
