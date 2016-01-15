@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! link_to_route('admin','Вернуться в админку', null, ['class'=>'btn btn-info']) !!}
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Товары</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        @if(count($products))
                        <table width="100%">
                            <tr>
                                <td>№ п/п</td>
                                <td>Артикул</td>
                                <td>Название</td>
                                <td>Описание</td>
                                <td>Завод</td>
                                <td>Год выпуска</td>
                                <td>Редактировать</td>
                                <td>Удалить</td>
                            </tr>
                            @foreach($products as $key=>$product)
                                <tr>
                                    <td>{{  $key +1 }}</td>
                                    <td>{{ $product->article }}</td>
                                    <td>{!! link_to_route('products.show', $product->name, $product->id) !!}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>({{ $product->factory->factory_code }})   {{ $product->factory->factory_name }}</td>
                                    <td>{{ $product->year->year }}</td>
                                    <td>{!! link_to_route('products.edit', 'Редактировать', $product->id, ['class'=>'btn btn-info']) !!}</td>
                                    <td>@include('products._destroyForm')</td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                            <b>Таблица товаров не заполнена</b><br>
                        @endif
                            {!! link_to_route('products.create', 'Добавить товар', null, ['class'=>'btn btn-success']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection