<div class="row">
    @if($product)
        {!! Form::open(['action' => ['ProductController@update', $id], 'role' => 'form']) !!}
    @else
        {!! Form::open(['action' => 'ProductController@store', 'role' => 'form']) !!}
    @endif
    @if($product)
	{!! Form::hidden('_method', 'put') !!}
    @endif
    <div class="form-group">
        <label class="col-md-4 control-label">Группа товаров</label>
        <select class="form-control" name="category_id">
            <option>Без группы</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $categoryID == $category->id ? 'selected' : null }}>{{ $category->category }}</option>
            @endforeach
        </select>
        @if($errors->has('category_id'))
            <div class="alert-danger alert">{!! $errors->first('category_id') !!}</div>
        @endif
    </div>
    <div class="form-group">
        {!! Form::text('name', $product ? $product->name : $product, ['placeholder'=>'Название товара', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('name'))
            <div class="alert-danger alert">{!! $errors->first('name') !!}</div>
        @endif
    </div>
    <div class="form-group">
        {!! Form::text('article', $product ? $product->article : $product, ['placeholder'=>'Артикул товара', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('article'))
            <div class="alert-danger alert">{!! $errors->first('article') !!}</div>
        @endif
    </div>
    <div class="form-group">
        {!! Form::textArea('description', $product ? $product->description : $product, ['placeholder'=>'Описание товара', 'class'=>'form-control', 'required'=>true]) !!}
        @if($errors->has('description'))
            <div class="alert-danger alert">{!! $errors->first('description') !!}</div>
        @endif
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">Состояние</label>
        <select class="form-control" name="condition_id">
            @foreach($conditions as $condition)
                <option value="{{ $condition->id }}" {{ $conditionID == $condition->id ? 'selected' : null }}>{{ $condition->condition }}</option>
            @endforeach
        </select>
        @if($errors->has('condition_id'))
            <div class="alert-danger alert">{!! $errors->first('condition_id') !!}</div>
        @endif
    </div>
    <h3>Цены и количества</h3>
        @if($product)
            <?$prevTrainRoad = null;?>
            <table border="1" width="100%">
                <tr align="center">
                    <td>Депо</td>
                    <td>Цена</td>
                    <td>Количество</td>
                </tr>
            @foreach($prices as $key => $price)
                    <tr align="center">
                        <td colspan="5">
                            <?$trName = key($price);?>
                            {{ $trName }}:
                            <br>
                            <label>Цена товара для всех депо на этой дороге</label>
                            {!! Form::text('priceForAll'.$key, null, ['placeholder'=>'Цена товара для всех депо на этой железной дороге '.$trName, 'class'=>'form-control priceForAll']) !!}
                        </td>
                    </tr>
                @foreach($price[$trName] as $item)
                    <tr align="center">
                        <td>{{ $item['stantion_name'] }}</td>
                        <td>
                            {!! Form::text('price'.$item['stantion_id'], $item['price'], ['placeholder'=>'Цена товара в депо '.$item['stantion_name'], 'class'=>'form-control priceForAll'.$key, 'required'=>true]) !!}
                            @if($errors->has('price'.$item['stantion_id']))
                                <div class="alert-danger alert">{!! $errors->first('price'.$item['stantion_id']) !!}</div>
                            @endif
                        </td>
                        <td>
                            {!! Form::text('amount'.$item['stantion_id'], $item['amount'], ['placeholder'=>'Количество товара в депо '.$item['stantion_name'], 'class'=>'form-control', 'required'=>true]) !!}
                            @if($errors->has('amount'.$item['stantion_id']))
                                <div class="alert-danger alert">{!! $errors->first('amount'.$item['stantion_id']) !!}</div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </table>
        @else
            @foreach($trainRoads as $trainRoad)
                <div class="form-group">

                    @if(count($trainRoad->stantion))
                        <p>
                            <b>{{ $trainRoad->tr_name }}:</b>
                            <br>
                            <label>Цена товара для всех депо на этой дороге</label>
                            {!! Form::text('priceForAll'.$trainRoad->id, null, ['placeholder'=>'Цена товара на всей железной дороге '.$trainRoad->tr_name, 'class'=>'form-control priceForAll']) !!}
                        </p>
                        <p>
                            <table border="1" width="100%">
                                <tr>
                                    <td>Депо</td>
                                    <td>Цена</td>
                                    <td>Количество</td>
                                </tr>
                                @foreach($trainRoad->stantion as $depo)
                                        <tr>
                                            <td>{{ $depo->stantion_name }}</td>
                                            <td>
                                                {!! Form::text('price'.$depo->id, 0.00, ['placeholder'=>'Цена товара в депо '.$depo->stantion_name, 'class'=>'form-control priceForAll'.$trainRoad->id, 'required'=>true]) !!}
                                                @if($errors->has('price'.$depo->id))
                                                    <div class="alert-danger alert">{!! $errors->first('price'.$depo->id) !!}</div>
                                                @endif
                                            </td>
                                            <td>
                                                {!! Form::text('amount'.$depo->id, 0, ['placeholder'=>'Количество товара в депо '.$depo->stantion_name, 'class'=>'form-control', 'required'=>true]) !!}
                                                @if($errors->has('amount'.$depo->id))
                                                    <div class="alert-danger alert">{!! $errors->first('amount'.$depo->id) !!}</div>
                                                @endif
                                            </td>
                                        </tr>
                                @endforeach
                            </table>
                        </p>
                    @endif
                </div>
            @endforeach
        @endif
    {!! Form::submit( $product ? 'Изменить' : 'Создать',['class'=>'btn btn-success']) !!}

    {!! Form::close() !!}
</div>
