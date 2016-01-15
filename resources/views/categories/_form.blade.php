<div class="row">
    @if($cat)
        {!! Form::open(['action' => ['CategoryController@update', $id], 'role' => 'form']) !!}
    @else
        {!! Form::open(['action' => 'CategoryController@store', 'role' => 'form']) !!}
    @endif
    @if($cat)
	{!! Form::hidden('_method', 'put') !!}
    @endif
    <div class="form-group">
        {!! Form::text('category', $cat, ['placeholder'=>'Название группы товаров', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('category'))
            <div class="alert-danger alert">{!! $errors->first('category') !!}</div>
        @endif
    </div>
    {!! Form::submit( $cat ? 'Изменить' : 'Создать',['class'=>'btn btn-success']) !!}

    {!! Form::close() !!}
</div>
