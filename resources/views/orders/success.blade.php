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
                @if($ordersAmount > 1)
                    <h2 class="p4">Заказы в количестве {{ $ordersAmount }}шт. оформлены!</h2>
                @else
                    <h2 class="cnt">Заказ оформлен!</h2>
                @endif

                    @if($ordersAmount > 1)
                        <h2>Спасибо за заказы!</h2>
                        {{--<p>Счета в количестве {{ $ordersAmount }}шт. высланы на вашу электронную почту</p>--}}
                        {{--<p><b>Внимание!!!</b> Если один из счетов не будет оплачен через ?????? дней, заказ по этому депо автоматически анулируется</p>--}}
                    @else
                        <h2 class="cnt">Спасибо за заказ!</h2>
                        {{--<p class="totalSum">Счет выслан на вашу электронную почту</p>--}}
                        {{--<p class="totalSum"><b>Внимание!!!</b> Если счет не будет оплачен через 3 дня, заказ будет анулирован</p>--}}
                    @endif
                    <p class="totalSum">Увидеть подробную информацию о своих заказах и документах, Вы можете в разделе меню "Личный кабинет"</p>
                    <hr>
            </div>
        </div>
    </section>
@stop