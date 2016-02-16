@extends('public')

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
                <h2 class="p4">Корзина покупок</h2>
                @if(count($productCartArr))
                    <table width="100%">
                        <tr>
                            <td>№ п/п</td>
                            <td>Название товара</td>
                            <td>Цена</td>
                            <td>Количество</td>
                            <td>Сумма</td>
                            <td></td>
                        </tr>
                        @foreach($productCartArr as $stKey=>$stantionsArr)
                            <tr align="center"><td colspan="6"><hr><b>Депо {{$stKey}}</b><hr></td></tr>
                            @foreach($stantionsArr as $key=>$item)
                                <tr>
                                    <td>{{  $key +1 }}</td>
                                    <td>{{$item['name']}}</td>
                                    <td id="price_{{ $item['id'] }}">{{$item['price']}}</td>
                                    <td class="parent{{ $item['id'] }}">
                                        <input type="number" name="{{ $item['id'] }}" value="{{ $item['amount'] }}" class="productCartAmount" size="4"/>
                                    </td>
                                    <td id="sum_{{ $item['id'] }}" class="sum">{{ $item['price'] * $item['amount'] }}</td>
                                    <td>@include('productCart._destroyForm')</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </table>
                    @if(Auth::user())
                        <p class="totalSum">Итого на сумму <b>{{ $totalSum }}</b> руб.</p>
                        <form method="POST" action="{!! action('OrderController@confirm',['userID'=>$userID])!!}" accept-charset="UTF-8" role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <input type="submit" class="btn btn-success" value="Оформить заказ" />
                        </form>
                    @endif
                @else
                    <b>Корзина пуста</b><br>
                @endif
                {!! link_to_route('trainCar','Вернуться на страницу покупок', null, ['class'=>'btn btn-info']) !!}
            </div>
            <div class="sub-page-right">
                <h2 class="p3">Most Popular</h2>
                <p class="upper p5"><a href="#" class="link">Product name #1</a><br>Lorem ipsum dolor sit amet, consectetur adipi sicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                <p class="upper p5"><a href="#" class="link">Product name #2</a><br>Lorem ipsum dolor sit amet, consectetur adipi sicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                <p class="upper"><a href="#" class="link">Product name #3</a><br>Lorem ipsum dolor sit amet, consectetur adipi sicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                <a href="#" class="button-2 top-1">Read More</a>
            </div>
        </div>
    </section>
@stop

@section('jsScripts')
    <script src="{{ asset('/js/recount.js') }}"></script>
@stop