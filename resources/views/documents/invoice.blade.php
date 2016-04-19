<!DOCTYPE html>
<html lang="en">
<head>
    <title>Счет</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <!-- end of meta tags -->
    <!-- stylesheets -->

    <!-- end of stylesheets -->

    <style type="text/css">
        body {
            padding-top: 20px;
            padding-bottom: 40px;
        }
        /* Custom container */
        .container {
            margin: 0 auto;
            width:772px;
        }
        .container-narrow > hr {
            margin: 30px 0;
        }
        .border {
            border: 1px solid #000;
        }
        .border-top {
            border-top: 1px solid #000;
        }
        .pp {
            width:93%;
        }
        .signBlock {
            height: 50px;
            position: relative;
        }
        .signTitle {
            float: left;
        }
        .clear {
            clear: left;
            position: relative;
            top: -50px;
        }
        .stamp {
            background-image: url("{{ asset('/invoices/stamp.jpg') }}");
            height: 100px;
            width: 100px;
            float: left;
            display: inline-block;
        }
        .qwe {
            position: absolute;
            top: -20px;
            left: 180px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
<div class="container">
        <p><b>Внимание! Оплата данного счета  означает согласие с условиями поставки товара. Уведомление об оплате<br>обязательно, в противном случае не гарантируется наличие товара на складе. Товар отпускается по факту<br>прихода денег на р/с Поставщика.</b></p>
        <p class="text-center"><b>Образец заполнения платежного поручения</b></p>
        <table class="pp border">
            <tr>
                <td class="border">ИНН {{ $selfFirm->inn }}</td>
                <td class="border">КПП {{ $selfFirm->kpp }}</td>
                <td class="border text-center" style="width: 54px;" rowspan="3" valign="bottom">Сч. №</td>
                <td class="border" style="width: 218px;" rowspan="3" valign="bottom">{{ $selfFirm->rs }}</td>
            </tr>
            <tr>
                <td colspan="2">Получатель</td>
            </tr>
            <tr>
                <td colspan="2">{{ $selfFirm->organisation_name }} ОГРН {{ $selfFirm->ogrn }}</td>
            </tr>
            <tr class="border-top">
                <td colspan="2">Банк получателя</td>
                <td class="border text-center">БИК</td>
                <td>{{ $selfFirm->bik }}</td>
            </tr>
            <tr>
                <td colspan="2">{{ $selfFirm->bank }}</td>
                <td class="border text-center" valign="top">Сч. №</td>
                <td valign="top">{{ $selfFirm->ks }}</td>
            </tr>
        </table>
        <h3>СЧЕТ  измененный № {{ $orderNumber.' - '.$depoId }} от {{ $orderDate }} г.</h3>
        <div style="height: 3px; background-color: black; width: 93%;"></div>
        <table>
            <tr>
                <td valign="top"><b>Поставщик:</b></td>
                <td><b>
                        ИНН {{ $selfFirm->inn }} КПП {{ $selfFirm->kpp }}
                    </b>
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Покупатель:</b></td>
                <td><b>
                        {{ $firm->organisation_name }}ИНН {{ $firm->inn }} КПП {{ $firm->kpp }}
                    </b>
                </td>
            </tr>
        </table>
        <table class="pp border">
            <tr>
                <td class="border text-center" >№</td>
                <td class="border text-center" width="50%">Наименование товара</td>
                <td class="border text-center" >Единица-<br>измерения</td>
                <td class="border text-center" >Коли-<br>чество</td>
                <td class="border text-center" >Цена<br> руб.</td>
                <td class="border text-center" >Сумма</td>
            </tr>
            <?
                $totalSum = 0;
                $productCount = 0;
                $totalVAT = 0;
            ?>
            @foreach($products as $stKey=>$stationsArr)
                <?
                    $sumInDepo = 0;
                    $totalSumInDepo = 0;
                    $totalVATInDepo = 0;
                    $withoutVAT = false;
                    $withoutVATArr = [];
                ?>
                @foreach($stationsArr as $key=>$item)
                    <tr>
                        <td class="border text-right">{{  $key +1 }}</td>
                        <td class="border">{{$item['product_name']}}</td>
                        <td class="border text-center">шт.</td>
                        <td class="border text-right">{{$item['product_amount']}}</td>
                        <td class="border text-right">{{sprintf("%0.2f", $item['product_price'])}}</td>
                        <td class="border text-right">{{ sprintf("%0.2f", ($sumInDepo = $item['product_price'] * $item['product_amount'])) }}</td>
                    </tr>
                    <?
                        if($item['product_nds'] == -1) {
                            $withoutVAT = true;
                        } else {
                            $withoutVAT = false;
                        }
                        $withoutVATArr[] = $item['product_nds'];
                        $totalSumInDepo += $sumInDepo;
                        $VAT_rate = $withoutVAT ? 0 : $item['product_nds'];
                        $totalVATInDepo += $sumInDepo/(100+$VAT_rate)*$VAT_rate;
                        $productCount++;
                    ?>
                @endforeach
                <?
                    $totalSum += $totalSumInDepo;
                    $totalVAT += $totalVATInDepo;
                ?>
            @endforeach

            <tr>
                <td class="text-right" colspan="5"><b>Итого:</b></td>
                <td class="border text-right"><b>{{ sprintf("%0.2f", $totalSum) }} руб.</b></td>
            </tr>
            <tr>
                <td class="text-right" colspan="5"><b>В том числе НДС:</b></td>
                <td class="border text-right"><b>{{ \App\Models\Product::isWithoutVAT($withoutVATArr) ? 'без НДС' : sprintf("%0.2f", $totalVAT) }}</b></td>
            </tr>
            <tr>
                <td class="text-right" colspan="5"><b>Всего к оплате:</b></td>
                <td class="border text-right"><b>{{ sprintf("%0.2f", $totalSum) }} руб.</b></td>
            </tr>
        </table>
        Всего наименований {{ $productCount }}, на сумму {{ sprintf("%0.2f", $totalSum) }} руб.            <br>
        <b>{{ \App\Models\Order::num2str($totalSum) }}</b>
        <div class="signBlock">
            <div>Руководитель предприятия_______________({{ $selfFirm->face_fio }})</div>
            <div class="stamp qwe"></div>
        </div>
</div>

</body>
</html>