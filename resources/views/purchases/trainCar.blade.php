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
                <table width="100%">
                @foreach($regions as $region)
                    <tr class="with-bottom-margin">
                        <td width="20%" class="vertical-center" align="center">
                            <h3>{{ $region->reg_name }}</h3>
                        </td>
                        <td width="80%">
                            <table border="1" width="100%">
                                @foreach($region->train_road as $tr)
                                    <tr>
                                        <td class="vertical-center" align="center">
                                            <h3>{{ $tr->tr_name }}</h3>
                                        </td>
                                        <td width="50%">
                                            <table border="1" width="100%">
                                                @foreach($tr->stantion as $depo)
                                                    <tr><td  align="center"><h4>{!! link_to_route('trainCarPriceList',$depo->stantion_name,['id'=>$depo->id]) !!}</h4></td></tr>
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
            <div class="sub-page-right">
                <h2 class="p3">{!! link_to_route('productCart','Корзина покупок') !!}</h2>
                @if($productsCount)
                    <p class="upper p5">В корзине <b>{{ $productsCount }}</b> товаров</p>
                    <p class="upper p5">На сумму <b>{{ $productsSum }}</b> руб.</p>
                @else
                    <p class="upper p5">Корзина пуста</p>
                @endif

                {!! link_to_route('productCart','Войти в корзину покупок',null,['class'=>'button-2 top-1']) !!}
            </div>
        </div>
    </section>
@stop