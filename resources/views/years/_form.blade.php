<div class="row">
    @if($year)
        {!! Form::open(['action' => ['YearController@update', $id], 'role' => 'form']) !!}
    @else
        {!! Form::open(['action' => 'YearController@store', 'role' => 'form']) !!}
    @endif
    @if($year)
	{!! Form::hidden('_method', 'put') !!}
    @endif
    <div class="form-group">
        {!! Form::text('year', $year, ['placeholder'=>'Год выпуска', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('year'))
            <div class="alert-danger alert">{!! $errors->first('year') !!}</div>
        @endif
    </div>
    {!! Form::submit( $year ? 'Изменить' : 'Создать',['class'=>'btn btn-success']) !!}

    {!! Form::close() !!}
</div>
