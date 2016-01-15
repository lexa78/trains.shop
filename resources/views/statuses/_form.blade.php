<div class="row">
    @if($status)
        {!! Form::open(['action' => ['StatusController@update', $id], 'role' => 'form']) !!}
    @else
        {!! Form::open(['action' => 'StatusController@store', 'role' => 'form']) !!}
    @endif
    @if($status)
	    {!! Form::hidden('_method', 'put') !!}
    @endif
    <div class="form-group">
        {!! Form::text('status', $status ? $status :  old('status'), ['placeholder'=>'Название статуса заказа', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('status'))
            <div class="alert-danger alert">{!! $errors->first('status') !!}</div>
        @endif
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label" for="is_first">Это начальный статус?</label>
        <select id="is_first" name="is_first" class="form-control">
            <option value="0">Нет</option>
            <option value="1">Да</option>
        </select>
    </div>
    {!! Form::submit( $status ? 'Изменить' : 'Создать',['class'=>'btn btn-success']) !!}

    {!! Form::close() !!}
</div>
