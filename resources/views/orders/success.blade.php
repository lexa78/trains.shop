@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    @if($ordersAmount > 1)
                        <div class="panel-heading">Заказы в количестве {{ $ordersAmount }}шт. оформлены!</div>
                    @else
                        <div class="panel-heading">Заказ оформлен!</div>
                    @endif

                    <div class="panel-body">
                        @if($ordersAmount > 1)
                            <h2>Спасибо за заказы!</h2>
                            <p>Счета в количестве {{ $ordersAmount }}шт. высланы на вашу электронную почту</p>
                            <p><b>Внимание!!!</b> Если один из счетов не будет оплачен через ?????? дней, заказ по этому депо автоматически анулируется</p>
                        @else
                            <h2>Спасибо за заказ!</h2>
                            <p>Счет выслан на вашу электронную почту</p>
                            <p><b>Внимание!!!</b> Если счет не будет оплачен через ?????? дней, заказ автоматически анулируется</p>
                        @endif
                        <p>Посмотреть, скачать, распечатать счета Вы можете в разделе {!! link_to_route('showMyDocs','Мои документы') !!}</p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
