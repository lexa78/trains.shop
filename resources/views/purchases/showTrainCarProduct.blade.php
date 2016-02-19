@extends('public')

@section('purchases_cart')
    <div class="purchases_cart">
        <div class="title-in-purchases_cart">Запчасти</div>
        {!! link_to_route('productCart','Заказано '.$productsCount.' запчастей') !!}
    </div>
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
                <div class="panel panel-default">
                    <div class="totalSum cnt">Подробное описание товара {{$product->name}}</div>
                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>

                        <p><b>Группа товара:&nbsp;</b>{{ $product->category_id ? $productParams[0]->category : 'без группы'}}</p>
                        <p><b>Название:&nbsp;</b>{{ $product->name }}</p>
                        <p><b>Артикул:&nbsp;</b>{{ $product->article }}</p>
                        <p><b>Описание:&nbsp;</b>{{ $product->description }}</p>
                        <p><b>Состояние:&nbsp;</b>{{ $productParams[0]->condition }}</p>
                        <p><b>Завод-производитель:&nbsp;</b>({{ $productParams[0]->factory_code }}) {{ $productParams[0]->factory_name }}</p>
                        <p><b>Год выпуска:&nbsp;</b>{{ $productParams[0]->year }}</p>
                        <br>
                        <div class="totalSum cnt">Цены и количества в других депо</div>
                        @if(! $userID)
                            <p class="alert alert-warning">Чтобы появилась возможность добавлять товары в корзину,
                                необходимо <a href="{{ url('/auth/login') }}">Войти</a> или
                                <a href="{{ url('/auth/register') }}">Зарегистрироваться</a>
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                        <table border="1" width="100%">
                            <tr align="center">
                                <td>Депо</td>
                                <td>Цена</td>
                                <td>В наличии</td>
                                <td></td>
                            </tr>
                            @foreach($prices as $key => $price)
                                <tr align="center"><td colspan="5">{{ $key }}:</td></tr>
                                @foreach($price as $item)
                                    <tr align="center">
                                        @if($item['stantion_id'] == $depoId)
                                            <td><b>{{ $item['stantion_name'] }}</b></td>
                                        @else
                                            <td>{{ $item['stantion_name'] }}</td>
                                        @endif
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
                        </table>
                        {!! link_to_route('trainCarPriceList','Назад', ['id'=>$depoId], ['class'=>'button']) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('jsScripts')
    <script src="{{ asset('/js/jquery-1.7.min.js') }}"></script>
    <script src="{{ asset('/js/addToCartAmount.js') }}"></script>
@stop