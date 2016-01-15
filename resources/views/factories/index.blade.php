@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! link_to_route('admin','Вернуться в админку', null, ['class'=>'btn btn-info']) !!}
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Заводы-производители</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        @if(count($factories))
                        <table>
                            <tr>
                                <td>№ п/п</td>
                                <td>Код завода</td>
                                <td>Название завода</td>
                                <td>Редактировать</td>
                                <td>Удалить</td>
                            </tr>
                            @foreach($factories as $key=>$factory)
                                <tr>
                                    <td>{{  $key +1 }}</td>
                                    <td>{{$factory->factory_code}}</td>
                                    <td>{{$factory->factory_name}}</td>
                                    <td>{!! link_to_route('factories.edit', 'Редактировать', $factory->id, ['class'=>'btn btn-info']) !!}</td>
                                    <td>@include('factories._destroyForm')</td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                            <b>Таблица заводов-производителей не заполнена</b><br>
                        @endif
                            {!! link_to_route('factories.create', 'Добавить завод-производитель', null, ['class'=>'btn btn-success']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection