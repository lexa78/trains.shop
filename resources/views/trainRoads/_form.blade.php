<div class="row">
    @if($tRoadName)
        {!! Form::open(['action' => ['TrainRoadsController@update', $id], 'role' => 'form']) !!}
    @else
        {!! Form::open(['action' => 'TrainRoadsController@store', 'role' => 'form']) !!}
    @endif
    @if($tRoadName)
	{!! Form::hidden('_method', 'put') !!}
    @endif
    <div class="form-group">
        <label class="col-md-4 control-label">Регион железной дороги</label>
        <select class="form-control" name="region_id">
            @foreach($regions as $region)
                <option value="{{ $region->id }}" {{ $regID == $region->id ? 'selected' : null }}>{{ $region->reg_name }}</option>
            @endforeach
        </select>
        @if($errors->has('region_id'))
            <div class="alert-danger alert">{!! $errors->first('region_id') !!}</div>
        @endif
    </div>
    <div class="form-group">
        {!! Form::text('tr_name', $tRoadName, ['placeholder'=>'Название железной дороги', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('tr_name'))
            <div class="alert-danger alert">{!! $errors->first('tr_name') !!}</div>
        @endif
    </div>
    {!! Form::submit( $tRoadName ? 'Изменить' : 'Создать',['class'=>'btn btn-success']) !!}

    {!! Form::close() !!}
</div>
