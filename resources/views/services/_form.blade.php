<div class="row">
    @if($service)
        {!! Form::open(['action' => ['ServiceController@update', $id], 'role' => 'form']) !!}
    @else
        {!! Form::open(['action' => 'ServiceController@store', 'role' => 'form']) !!}
    @endif
    @if($service)
	{!! Form::hidden('_method', 'put') !!}
    @endif
    <div class="form-group">
        {!! Form::text('short_name', $service ? $service->short_name : $service, ['placeholder'=>'Короткое название услуги', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('short_name'))
            <div class="alert-danger alert">{!! $errors->first('short_name') !!}</div>
        @endif
    </div>
    <div class="form-group">
        {!! Form::textArea('full_name', $service ? $service->full_name : $service, ['placeholder'=>'Полное название услуги', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('full_name'))
            <div class="alert-danger alert">{!! $errors->first('full_name') !!}</div>
        @endif
    </div>
    <div class="form-group">
        {!! Form::text('unit', $service ? $service->unit : $service, ['placeholder'=>'Единица измерения', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('unit'))
            <div class="alert-danger alert">{!! $errors->first('unit') !!}</div>
        @endif
    </div>
    <div class="form-group">
        {!! Form::text('period', $service ? $service->period : $service, ['placeholder'=>'Срок исполнения', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('period'))
            <div class="alert-danger alert">{!! $errors->first('period') !!}</div>
        @endif
    </div>
    <div class="form-group">
        {!! Form::textArea('documents', $service ? $service->documents : $service, ['placeholder'=>'Перечень документов, требуемых предоставить', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('documents'))
            <div class="alert-danger alert">{!! $errors->first('documents') !!}</div>
        @endif
    </div>
    <div class="form-group">
        {!! Form::text('price', $service ? $service->price : $service, ['placeholder'=>'Цена', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('price'))
            <div class="alert-danger alert">{!! $errors->first('price') !!}</div>
        @endif
    </div>
    <div class="form-group">
        <table class="forCheckbox">
            <tr>
                <td>
                    <input type="checkbox" class="qwe" name="need_station" id="need_station" @if($service && $service->need_station) checked @endif>
                </td>
                <td class="labelForCheckbox">
                    <label class="need_station" for="need_station">Нужно указывать станцию для этой услуги</label>
                </td>
            </tr>
        </table>
    </div>
    {!! Form::submit( $service ? 'Изменить' : 'Создать',['class'=>'btn btn-success']) !!}

    {!! Form::close() !!}
</div>
