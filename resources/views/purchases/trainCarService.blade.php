@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Услуги для грузовых вагонов</div>

                    <div class="panel-body">
                        <div id="region">
                            <select onchange="regionChange(this.value, false)" class="form-control">
                                <option value="isNotChanged">Выберите регион</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->reg_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="trainRoad">
                        </div>
                        <div id="station">
                        </div>
                        <div id="pricelist">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsScripts')
    <script src="{{ asset('/js/changeRegion.js') }}"></script>
@stop