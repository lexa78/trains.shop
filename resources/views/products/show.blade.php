@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    {!! link_to_route('products.index','Назад', null, ['class'=>'btn btn-info']) !!}
                    <div class="panel-heading">Подробное описание товара {{$product->name}}</div>
                    <div class="panel-body">
                        <p><b>Группа товара:&nbsp;</b>{{ $product->category_id ? $productParams[0]->category : 'без группы'}}</p>
                        <p><b>Название:&nbsp;</b>{{ $product->name }}</p>
                        <p><b>Артикул:&nbsp;</b>{{ $product->article }}</p>
                        <p><b>Описание:&nbsp;</b>{{ $product->description }}</p>
                        <p><b>Состояние:&nbsp;</b>{{ $productParams[0]->condition }}</p>
                        <h3>Цены и количества</h3>
                        <table border="1" width="100%">
                            <tr align="center">
                                <td>Депо</td>
                                <td>Ставка НДС</td>
                                <td>Цена с НДС</td>
                                <td>Количество</td>
                            </tr>
                            @foreach($prices as $key => $price)
                                <tr align="center"><td colspan="5">{{ $key }}:</td></tr>
                                @foreach($price as $item)
                                    <tr align="center">
                                        <td>{{ $item['stantion_name'] }}</td>
                                        <td>{{ $item['nds'] }}</td>
                                        <td>{{ $item['price'] }}</td>
                                        <td>{{ $item['amount'] }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection