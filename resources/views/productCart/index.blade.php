@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! link_to_route('trainCar','Вернуться на страницу покупок', null, ['class'=>'btn btn-info']) !!}
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Корзина</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
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
                                            <td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('jsScripts')
    <script src="{{ asset('/js/recount.js') }}"></script>
@stop