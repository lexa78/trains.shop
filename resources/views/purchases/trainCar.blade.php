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
                <h2 class="p4">Детали товарных вагонов</h2>
                <table>
                @foreach($regions as $region)
                    <tr>
                        <td width="25%">
                            <h3>{{ $region->reg_name }}</h3>
                        </td>
                        <td width="35%">
                            <table border="1" width="100%">
                                @foreach($region->train_road as $tr)
                                    <tr>
                                        <td>
                                            <h3>{{ $tr->tr_name }}</h3>
                                        </td>
                                        <td width="30%">
                                            <table border="1" width="100%">
                                                @foreach($tr->stantion as $depo)
                                                    <tr><td><h4>{!! link_to_route('trainCarPriceList',$depo->stantion_name,['id'=>$depo->id]) !!}</h4></td></tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                @endforeach
                </table>
                <table>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Duis autem vel</th>
                        <th>At vero eos et</th>
                        <th>Consetetur sadip</th>
                    </tr>
                    <tr>
                        <td>At vero eos et</td>
                        <td>eum iriure dolor in</td>
                        <td>accusam et justo</td>
                        <td>scing elitr, sed</td>
                    </tr>
                    <tr>
                        <td>accusam et justo</td>
                        <td>hendrerit in vulpu</td>
                        <td>duo dolores et ea </td>
                        <td>diam nonumy </td>
                    </tr>
                    <tr>
                        <td>duo dolores et ea </td>
                        <td>tate velit esse </td>
                        <td>rebum. Stet clita </td>
                        <td>eirmod tempor </td>
                    </tr>
                    <tr>
                        <td>rebum. Stet clita</td>
                        <td>molestie conse</td>
                        <td>kasd gubergren, </td>
                        <td>invidunt ut labore</td>
                    </tr>
                    <tr>
                        <td>kasd gubergren,</td>
                        <td>quat, vel illum</td>
                        <td>no sea takimata </td>
                        <td>et dolore magna </td>
                    </tr>
                    <tr>
                        <td>no sea takimata</td>
                        <td>dolore eu feugiat </td>
                        <td>sanctus est Lorem </td>
                        <td>aliquyam erat, sed </td>
                    </tr>
                    <tr>
                        <td>sanctus est</td>
                        <td>nulla facilisis at </td>
                        <td>ipsum dolor sit</td>
                        <td>diam voluptua. At</td>
                    </tr>
                    <tr>
                        <td>Lorem ipsum</td>
                        <td>vero eros et</td>
                        <td>amet. Lorem ipsum</td>
                        <td>vero eos et</td>
                    </tr>
                    <tr>
                        <td>dolor sit amet.</td>
                        <td>accumsan et iusto</td>
                        <td>dolor sit amet,</td>
                        <td>accusam et justo</td>
                    </tr>
                </table>
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

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Детали товарных вагонов</div>

                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        <div id="region">
                            <table border="1" width="100%">
                                @foreach($regions as $region)
                                    <tr>
                                        <td width="25%">
                                            <h2>{{ $region->reg_name }}</h2>
                                        </td>
                                        <td width="35%">
                                            <table border="1" width="100%">
                                            @foreach($region->train_road as $tr)
                                                <tr>
                                                    <td>
                                                        <h3>{{ $tr->tr_name }}</h3>
                                                    </td>
                                                    <td width="30%">
                                                        <table border="1" width="100%">
                                                            @foreach($tr->stantion as $depo)
                                                                <tr><td><h4>{!! link_to_route('trainCarPriceList',$depo->stantion_name,['id'=>$depo->id]) !!}</h4></td></tr>
                                                            @endforeach
                                                        </table>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
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
@endsection