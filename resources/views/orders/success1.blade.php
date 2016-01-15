@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Заказ № {{ $orderNumber }} оформлен!</div>

                    <div class="panel-body">
                        <table width="772">
                            <tr>
                                <td class="text-center">
                                    <b>Внимание! Оплата данного счета  означает согласие с условиями поставки товара. Уведомление об оплате<br>обязательно, в противном случае не гарантируется наличие товара на складе. Товар отпускается по факту<br>прихода денег на р/с Поставщика.</b>
                                </td>
                            </tr>

                            <tr><td>&nbsp;</td></tr>

                            <tr>
                                <td>
                                    <b>Счет действителен при выполнении следующих условий:</b>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="offset1">- сумма платежа строго соответствует указанной в счете и составляет 0,00 руб.;</div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="offset1">- платеж произведен в течение 3-х банковских дней с даты его выставления.</div>
                                </td>
                            </tr>

                            <tr><td>&nbsp;</td></tr>

                            <tr>
                                <td class="text-center">
                                    <b></b>
                                </td>
                            </tr>

                            <tr><td>&nbsp;</td></tr>

                            <tr>
                                <td>
                                    <div class="text-center"><b>Образец заполнения платежного поручения</b></div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <table class="pp border">
                                        <tr>
                                            <td class="border">ИНН 1212</td>
                                            <td class="border">КПП 1212</td>
                                            <td class="border text-center" style="width: 54px;" rowspan="3" valign="bottom">Сч. №</td>
                                            <td class="border" style="width: 218px;" rowspan="3" valign="bottom">11111111111111111111</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Получатель</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">ыв ОГРН 1212</td>
                                        </tr>
                                        <tr class="border-top">
                                            <td colspan="2">Банк получателя</td>
                                            <td class="border text-center">БИК</td>
                                            <td>121211111</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">ывыв ывыв</td>
                                            <td class="border text-center" valign="top">Сч. №</td>
                                            <td valign="top">11111111111111111111</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h3>СЧЕТ № 1 от 10.01.2016 г.</h3>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="height: 3px; background-color: black; width: 100%;"></div>
                                </td>
                            </tr>

                            <tr><td>&nbsp;</td></tr>

                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td valign="top"><b>Поставщик:</b></td>
                                            <td><b>
                                                    ИНН 1212/1212 КПП ыв ывыв</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top"><b>Покупатель:</b></td>
                                            <td><b>
                                                </b>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr><td>&nbsp;</td></tr>

                            <tr>
                                <td>
                                    <table class="pp" cellpadding="4">
                                        <tr>
                                            <td class="border text-center" width="20">№</td>
                                            <td class="border text-center" width="340">Наименование<br>товара</td>
                                            <td class="border text-center" width="60">Единица<br>изме-<br>рения</td>
                                            <td class="border text-center" width="50">Коли-<br>чество</td>
                                            <td class="border text-center" width="120">Цена</td>
                                            <td class="border text-center" width="120">Сумма</td>
                                        </tr>
                                        <tr>
                                            <td class="border text-right" valign="top">1</td>
                                            <td class="border"></td>
                                            <td class="border text-center" valign="bottom"></td>
                                            <td class="border text-right" valign="bottom">0</td>
                                            <td class="border text-right" valign="bottom">0-00</td>
                                            <td class="border text-right" valign="bottom">0-00</td>
                                        </tr>

                                        <tr>
                                            <td class="text-right" colspan="5"><b>Итого:</b></td>
                                            <td class="border text-right"><b>0-00</b></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="5"><b>Без налога (НДС).</b></td>
                                            <td class="border text-right"><b>
                                                    -</b></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="5"><b>Всего к оплате:</b></td>
                                            <td class="border text-right"><b>0-00</b></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr><td>&nbsp;</td></tr>

                            <tr>
                                <td>
                                    Всего наименований 1, на сумму 0.00            <br>
                                    <b>Ноль рублей 00 копеек</b>
                                </td>
                            </tr>

                            <tr><td>&nbsp;</td></tr>
                            <tr><td>&nbsp;</td></tr>

                            <tr>
                                <td>
                                    Руководитель предывывприятия_____________________ (ывы)
                                </td>
                            </tr>

                            <tr><td>&nbsp;</td></tr>
                            <tr><td>&nbsp;</td></tr>

                            <tr>
                                <td>
                                    Главный бухгалтерыв____________________________ (ывыв)
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
