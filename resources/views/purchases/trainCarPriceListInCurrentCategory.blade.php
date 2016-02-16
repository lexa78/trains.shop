@extends('public')

@section('purchases_cart')
    {!! link_to_route('productCart','Заказано '.$productsCount.' запчастей') !!}
@stop

@section('content')

    <section id="content"><div class="ic"></div>
        <div class="sub-page">

            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div>

            <div class="sub-page-left box-9">
                <h2 class="p4">Наличие товаров из категории {{$category}} во всех депо</h2>
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
                                                <input type="number" name="amount" class="addToCartAmount num_in_tbl" value="1" size="4"/>
                                                <input type="submit" value="В корзину" class="button-3">
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </table>

                {!! link_to_route('trainCarPriceList','Назад', ['id'=>$whatDepoIdWeAre], ['class'=>'button']) !!}
            </div>
        </div>
    </section>
@stop

@section('jsScripts')
    <script src="{{ asset('/js/jquery-1.7.min.js') }}"></script>
    <script src="{{ asset('/js/addToCartAmount.js') }}"></script>
@stop
