@extends('app')

@section('content')
    <div class="container">
        <div class="row">
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
                    <div class="panel-heading">Справочники для товаров</div>

                    <div class="panel-body">
                        <ul>
                            <li>{!! link_to_route('years.index','Годы выпуска ('.$yearsCount.')') !!}</li>
                            <li>{!! link_to_route('conditions.index','Состояния ('.$condCount.')') !!}</li>
                            <li>{!! link_to_route('factories.index','Заводы-производители ('.$factoriesCount.')') !!}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Товары</div>

                    <div class="panel-body">
                        <ul>
                            <li>{!! link_to_route('categories.index','Группы товаров ('.$catCount.')') !!}</li>
                            <li>{!! link_to_route('products.index','Товары ('.$productsCount.')') !!}</li>
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
                    <div class="panel-heading">Статусы заказов</div>

                    <div class="panel-body">
                        <ul>
                            <li>{!! link_to_route('statuses.index','Статусы заказов ('.$statusesCount.')') !!}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection