<!DOCTYPE html>
<html lang="en">
<head>
    <title>Счет</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <!-- end of meta tags -->
    <style type="text/css">
        body, html, div, table {
            margin: 0;
        }
        body {
            font-size: 14px;
        }
        .container {
            padding: 1cm 1cm 1cm 2cm;
        }
         .right {
            text-align: right;
        }
        .center {
            text-align: center;
        }
        .signBlock {
            height: 50px;
            position: relative;
        }
        .stamp {
            background-image: url("{{ asset('/invoices/stamp.png') }}");
            height: 105px;
            width: 150px;
            float: left;
            display: inline-block;
        }
        .qwe {
            position: absolute;
            top: -35px;
            left: 180px;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="right">Приложение № 1 к Договору поставки<br>
        №543-Д от «1» июня 2016 г.
    </div>
    <h3 class="center">СЧЕТ № {{ $orderNumber.' - '.$depoId }} от {{ $orderDate }} г.</h3>
    <div class="center">к Договору поставки № 543-Д от «1» июня 2016 г.</div>
    <div>г. Москва&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $orderDate }}</div>


    <p>Мы, ООО «ГАТИС» , именуемое в дальнейшем «Поставщик», в лице директора Тягуновой Галины Станиславовны, действующего на основании Устава, с одной стороны, и {{ $firm->organisation_name }}, именуемое в дальнейшем Покупатель, в лице  {{ $firmFacePosition }} {{ $firmRpFio }}, действующего на основании {{ $firmBaseDocument }}, удостоверяем, что сторонами достигнуто соглашение о цене и иных условиях поставки Товара, являющегося предметом Договора поставки № 543-Д от «1» июля 2016 г.</p>
    <p>1. Поставщик поставляет Покупателю следующий Товар:</p>
    <table border="1">
        <tr>
            <td>№<br>п/п</td>
            <td>Наименование Товара и адрес его местонахождения<br>(депо, в котором осуществляется выборка Товара)</td>
            <td>Кол-во,<br>шт.</td>
            <td>Цена за одну шт.,<br>руб.,вкл НДС</td>
            <td>Сумма за все<br>количество<br>Товара, руб. вкл.<br>НДС</td>
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
            $VATArr = [];
            ?>
            @foreach($stationsArr as $key=>$item)
                <tr>
                    <td class="border text-right">{{  $key +1 }}</td>
                    <td class="border">{{$item['product_name']}} Депо - {{ $depoName }}</td>
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

                if(isset($VATArr[$item['product_nds_as_str']])) {
                    $VATArr[$item['product_nds_as_str']] += $sumInDepo/(100+$VAT_rate)*$VAT_rate;
                } else {
                    $VATArr[$item['product_nds_as_str']] = $sumInDepo/(100+$VAT_rate)*$VAT_rate;
                }

                $productCount++;
                ?>
            @endforeach
            <?
            $totalSum += $totalSumInDepo;
            $totalVAT += $totalVATInDepo;
            ?>
        @endforeach
        <tr>
            <td colspan="5" align="right">ВСЕГО	{{ sprintf("%0.2f", $totalSum) }} руб.,</td>
        </tr>
        @foreach($VATArr as $nds=>$ndsSum)
        <tr>
            <td  colspan="5" align="right">в т.ч. НДС ({{ $nds }})   - 	{{ sprintf("%0.2f",$ndsSum) }} руб.</td>
        </tr>
        @endforeach
    </table>
    <p>2. Счет на оплату товара формируется после надлежащего оформления Заказа и направляется на электронную почту Покупателя в течение одного рабочего дня с момента оформления Покупателем Заказа на интернет-сайте: http://www.transgatis.com. Счет формируется на Сайте после оформления заказа и действителен в течение 3 (трех) рабочих дней с момента его формирования.</p>
    <p>3. Покупатель обязан оплатить счет в течение 3 (трех) рабочих дней, с момента его формирования на Сайте или получения счета Поставщика по электронной почте, в зависимости от того, какое из указанных событий наступит ранее. По истечении указанного срока, счет на оплату признается недействительным, а Договор незаключенным, за исключением случая признания Поставщиком произведенной оплаты надлежащим исполнением. Признание оплаты надлежащим исполнением осуществляется Поставщиком путем направления уведомления о принятии акцепта, полученного с опозданием по электронной почте Покупателя, указанной в Заказе, с последующим направлением оригинала почтовым отправлением.</p>
    <p>4. В платежном документе в назначении платежа Покупатель обязан указывать полный номер и дату счета на оплату Товара, сформированного при оформлении Заказа, а также сумму платежа и ставку НДС.</p>
    <p>Если Покупатель осуществил оплату Товара без расшифровки платежа или указал ошибочные реквизиты счета, то Поставщик вправе по своему усмотрению уточнять назначение платежа и отсрочить дату передачи Товара Покупателю на срок, соразмерный длительности времени, затраченного на уточнение назначения платежа или отказаться от поставки Товара. В случае принятия поставщиком решения об отказе в поставке Товара, настоящий Договор считается незаключенным, а счет недействительным.</p>
    <p>5. Оригиналы документов: счет - фактура, накладная формы ТОРГ-12, - предоставляются Поставщиком в течение 5 (пяти) календарных дней с момента осуществления выборки Товара Покупателем.</p>
    <p>6. Выборка Товара осуществляется Покупателем своими силами и за свой счет со склада Поставщика, указанного во втором столбце пункта 1 счета на оплату Товара (Наименование Товара и адрес его местонахождения).</p>
    <p>7. Покупатель обязуется осуществить выборку Товара в течение 10 (Десяти) календарных дней с даты оплаты 100% стоимости Товара по Счету. В случае если Покупатель допустит нарушение срока выборки Товара, указанного в настоящем пункте Договора, Поставщик принимает Товар на хранение. Порядок и сроки оплаты хранения Покупателем, а также последствия невыборки товара в течение 30 (Тридцати) календарных дней, с момента принятия Поставщиком Товара на хранение, указаны в п.3.2. Договора поставки.</p>
    <p>8. Поставщик гарантирует Покупателю, что Товар не обременен никакими правами или притязаниями третьих лиц. Если какие-либо требования третьих лиц будут обращены к Покупателю после принятия им Товара, то Поставщик будет являться ответственным за урегулирование всех таких требований и за возмещение Покупателю документально подтвержденных убытков, возникших вследствие этого.</p>
    <p>9. Оплатой настоящего счета Покупатель подтверждает свое безоговорочное согласие с условиями Договора поставки и настоящего счета на оплату Товара.</p>
    <p>10. Реквизиты для заполнения платежного поручения:</p>
    <table border="1">
        <tr>
            <td colspan="2" align="center">Получатель:</td>
            <td colspan="2" align="center">Банк получателя:</td>
        </tr>
        <tr>
            <td align="center">Наименование</td>
            <td align="center">{{ $selfFirm->organisation_name }}</td>
            <td align="center">Наименование</td>
            <td align="center">{{ $selfFirm->bank }}</td>
        </tr>
        <tr>
            <td align="center">ИНН</td>
            <td align="center">{{ $selfFirm->inn }}</td>
            <td align="center">БИК</td>
            <td align="center">{{ $selfFirm->bik }}</td>
        </tr>
        <tr>
            <td align="center">КПП</td>
            <td align="center">{{ $selfFirm->kpp }}</td>
            <td align="center">Кор. Счет</td>
            <td align="center">{{ $selfFirm->ks }}</td>
        </tr>
        <tr>
            <td align="center">ОГРН</td>
            <td align="center">{{ $selfFirm->ogrn }}</td>
            <td align="center"></td>
            <td align="center"></td>
        </tr>
        <tr>
            <td align="center">Расч. Счет</td>
            <td align="center">{{ $selfFirm->rs }}</td>
            <td align="center"></td>
            <td align="center"></td>
        </tr>
    </table>
    <br>
    <br>
    <div class="signBlock">
        <div>Директор {{ $selfFirm->organisation_name }}_______________({{ $selfFirm->face_fio }})</div>
        <div class="stamp qwe"></div>
    </div>
</div>

</body>
</html>