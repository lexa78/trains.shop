@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Заказы</div>

                    <div class="panel-body">
                        @if($newOrdersCount)
                            <p><b>{{ $newOrdersCount }} новых заказов.</b></p>
                            <p>{!! link_to_route('showOrdersToAdmin', 'Посмотреть', ['new_only'=>1]) !!}</p>
                        @else
                            <p>Новых заказов нет.</p>
                            <p>{!! link_to_route('showOrdersToAdmin', 'Посмотреть все заказы') !!}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Пункты назначения</div>

                    <div class="panel-body">
                        <ul>
                            <li>{!! link_to_route('regions.index','Регионы ('.$regionsCount.')') !!}</li>
                            <li>{!! link_to_route('trainRoads.index','Железные дороги ('.$tRoadsCount.')') !!}</li>
                            <li>{!! link_to_route('stations.index','Депо ('.$stationsCount.')') !!}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Товары</div>

                    <div class="panel-body">
                        <ul>
                            <li>{!! link_to_route('conditions.index','Состояния ('.$condCount.')') !!}</li>
                            <li>{!! link_to_route('categories.index','Группы товаров ('.$catCount.')') !!}</li>
                            <li>{!! link_to_route('products.index','Товары ('.$productsCount.')') !!}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Статусы заказов запчастей</div>

                    <div class="panel-body">
                        <ul>
                            <li>{!! link_to_route('statuses.index','Статусы заказов запчастей ('.$statusesCount.')') !!}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Услуги</div>

                    <div class="panel-body">
                        <ul>
                            <li>{!! link_to_route('services.index','Услуги ('.$servicesCount.')') !!}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Статусы заказов услуг</div>

                    <div class="panel-body">
                        <ul>
                            <li>{!! link_to_route('service_statuses.index','Статусы заказов услуг ('.$serviceStatusesCount.')') !!}</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection