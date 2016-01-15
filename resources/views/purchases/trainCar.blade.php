@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Детали товарных вагонов</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        <div id="region">
                            <table border="1" width="100%">
                                @foreach($regions as $region)
                                    <tr>
                                        <td width="25%">
                                            <h2>{{ $region->reg_name }}</h2>
                                        </td>
                                        <td width="35%">
                                            <table border="1" width="100%">
                                            @foreach($region->train_road as $tr)
                                                <tr>
                                                    <td>
                                                        <h3>{{ $tr->tr_name }}</h3>
                                                    </td>
                                                    <td width="30%">
                                                        <table border="1" width="100%">
                                                            @foreach($tr->stantion as $depo)
                                                                <tr><td><h4>{!! link_to_route('trainCarPriceList',$depo->stantion_name,['id'=>$depo->id]) !!}</h4></td></tr>
                                                            @endforeach
                                                        </table>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> {!! link_to_route('productCart','Корзина покупок') !!}</div>

                    <div class="panel-body">
                        @if($productsCount)
                            <p>В корзине <b>{{ $productsCount }}</b> товаров</p>
                            <p>На сумму <b>{{ $productsSum }}</b> руб.</p>
                        @else
                            <p>Корзина пуста</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection