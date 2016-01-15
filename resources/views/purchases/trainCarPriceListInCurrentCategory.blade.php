@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    {!! link_to_route('trainCarPriceList','Назад', ['id'=>$whatDepoIdWeAre], ['class'=>'btn btn-info']) !!}
                    <div class="panel-heading">Наличие товаров из категории {{$category}} во всех депо</div>
                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        @if(! $userID)
                            <p class="alert alert-warning">Чтобы появилась возможность добавлять товары в корзину,
                                необходимо <a href="{{ url('/auth/login') }}">Войти</a> или
                                <a href="{{ url('/auth/register') }}">Зарегистрироваться</a>
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif

                        <h2>Товары из категории {{ $category }}</h2>

                        <h3>Цены и количества</h3>
                        <table border="1" width="100%">
                            <tr align="center">
                                <td>Товар</td>
                                <td>Цена</td>
                                <td>В наличии</td>
                                <td></td>
                            </tr>
                            @foreach($productsArr as $trainRoadName => $trainRoad)
                                <tr align="center"><td colspan="4"><b>{{ $trainRoadName }}</b></td></tr>
                                @foreach($trainRoad as $depoName => $depo)
                                    <? $flag = false; ?>
                                    @if($depoName == $whatDepoNameWeAre)
                                        <tr align="center" bgcolor="#daa520"><td colspan="4">{{ $depoName }}</td></tr>
                                        <? $flag = true; ?>
                                    @else
                                        <tr align="center"><td colspan="4">{{ $depoName }}</td></tr>
                                    @endif

                                    @foreach($depo as $item)
                                        <tr align="center" bgcolor={{ $flag ?  '#daa520' : 'white'}}>
                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ $item['price'] }}</td>
                                            <td>{{ $item['amount'] }}</td>
                                            <td>
                                                @if($userID)
                                                    <form method="POST" action="{!! action('ProductCartController@store',[
                                                                                                                    'userID'=>$userID,
                                                                                                                    'productID'=>$item['product_id'],
                                                                                                                    'priceID'=>$item['price_id'],
                                                     ])!!}" accept-charset="UTF-8" role="form">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                        <input type="number" name="amount" class="addToCartAmount" value="1" size="4"/>
                                                        <input type="submit" value="В корзину">
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </table>

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
@stop

@section('jsScripts')
    <script src="{{ asset('/js/addToCartAmount.js') }}"></script>
@stop