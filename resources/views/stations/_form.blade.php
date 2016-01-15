<div class="row">
    @if($stationName)
        {!! Form::open(['action' => ['StationController@update', $id], 'role' => 'form']) !!}
    @else
        {!! Form::open(['action' => 'StationController@store', 'role' => 'form']) !!}
    @endif
    @if($stationName)
	{!! Form::hidden('_method', 'put') !!}
    @endif
    <div class="form-group">
        <label class="col-md-4 control-label">Железная дорога</label>
        <select class="form-control" name="train_road_id">
            @foreach($trainRoads as $trainRoad)
                <option value="{{ $trainRoad->id }}" {{ $trID == $trainRoad->id ? 'selected' : null }}>{{ $trainRoad->tr_name }}</option>
            @endforeach
        </select>
        @if($errors->has('train_road_id'))
            <div class="alert-danger alert">{!! $errors->first('train_road_id') !!}</div>
        @endif
    </div>
    <div class="form-group">
        {!! Form::text('stantion_name', $stationName, ['placeholder'=>'Название депо', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('stantion_name'))
            <div class="alert-danger alert">{!! $errors->first('stantion_name') !!}</div>
        @endif
    </div>
    {!! Form::submit( $stationName ? 'Изменить' : 'Создать',['class'=>'btn btn-success']) !!}

    {!! Form::close() !!}
</div>
