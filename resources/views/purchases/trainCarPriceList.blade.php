@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Товары и цены в депо {{ $depoName }}</div>

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
                    <table border="1" width="100%">
                        <tr align="center">
                            <td>№ п/п</td>
                            <td>Название</td>
                            <td>Описание</td>
                            <td>Завод производитель</td>
                            <td>Год выпуска</td>
                            <td>Цена</td>
                            <td>В наличии</td>
                            <td></td>
                        </tr>

                        @foreach($categoriesArr as $category_name=>$category)
                            <tr align="center"><td colspan="8">{!! link_to_route('trainCarPriceListInCategory',$category_name,['category_name'=>$category_name, 'depoId'=>$depoId]) !!}</td></tr>
                            @foreach($category as $key=>$product)
                                <tr>
                                    <td>{{  $key +1 }}</td>
                                    <td>{!! link_to_route('showTrainCarProduct',$product['name'],['id'=>$product['product_id'], 'depoId'=>$product['depo_id']]) !!}</td>
                                    <td>{{$product['description']}}</td>
                                    <td>({{ $product['factory_code'] }})   {{ $product['factory_name'] }}</td>
                                    <td>{{$product['year']}}</td>
                                    <td>{{$product['price']}}</td>
                                    <td>{{$product['amount']}}</td>
                                    <td>
                                        @if($userID)
                                            <form method="POST" action="{!! action('ProductCartController@store',[
                                                                                                                    'userID'=>$userID,
                                                                                                                    'productID'=>$product['product_id'],
                                                                                                                    'priceID'=>$product['price_id'],
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
                    </table>

                    {!! link_to_route('trainCar', 'Назад', null, ['class'=>'btn btn-info']) !!}
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