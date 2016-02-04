<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        .nobr {
            white-space: nowrap;
        }

        td {
            font-family: Verdana, Arial, sans-serif;
            font-size: 7pt;
            font-weight: normal;
            color: black;
            line-height: 7pt;
        }

        .greatHeader {
        font-family: Verdana, Arial, sans-serif;
        font-size: 16pt;
        font-weight: normal;
        color: #000000;
        padding-left: 11px;
        }

        .header1 {
        font-family: Verdana, Arial, sans-serif;
        font-size: 13pt;
        color: #000000;
        padding-right: 10px;
        padding-bottom: 3px;
        }

        .smallFont {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 8pt;
        color: #000000;
        }

        .smallFont a {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 8pt;
            text-decoration: none;
            color: #3A76B1;
        }

        .smallFont a:hover {
            text-decoration: underline;
        }

        h1 {
            font-family: Verdana, Arial, sans-serif;
            font-size: 15pt;
            color: #000000;
            font-weight: normal;
            margin-top: 0px;
        }

        .title {
        font-family: Verdana, Arial, sans-serif;
        font-size: 15pt;
        color: #000000;
        font-weight: normal;
        margin-top: 0px;
        }

        .header2 {
        font-family: Verdana, Arial, sans-serif;
        font-size: 14px;
        font-weight: bold;
        color: #362F2D;
        }

        .pageSubheader {
        font-family: Verdana, Arial, sans-serif;
        font-size: 12pt;
        color: #000000;
        font-weight: normal;
        }

        .smallhead {
        border-bottom: 0px;
        }

        .largeText {
        font-family: Verdana, Arial, sans-serif;
        font-size: 18px;
        font-weight: bold;
        }

        .largeText_normal {
        font-family: Verdana, Arial, sans-serif;
        font-size: 18px;
        }

        .greatText {
        font-family: Verdana, Arial, sans-serif;
        font-size: 22px;
        font-weight: bold;
        }

        .pageHeader {
        font-family: Verdana, Arial, sans-serif;
        font-size: 15pt;
        color: #000000;
        font-weight: normal;
        background-color: #F5EBD6;
        margin-top: 0px;
        padding-left: 10px;
        padding-top: 7px;
        padding-bottom: 5px;
        }

        html,body {
            height: 100%;
            margin: 0px;
            padding: 5px;
            background-color: #FFFFFF;
            font-family: Verdana, Arial, sans-serif;
            font-size: 10pt;
        }

        form {
            height: 100%;
            margin: 0px;
            padding: 0px
        }

        .separator {
        overflow: hidden;
        }

        .list {
        margin-top: 0px;
        border: 1px solid #B1B1B1;
        }

        .list td {
            padding-left: 5px;
            padding-right: 5px;
            border-top: 1px solid #B1B1B1;
        }

        .list th {
            padding-left: 5px;
            padding-right: 5px;
            font-family: Verdana, Arial, sans-serif;
            font-size: 10pt;
            font-weight: bold;
            color: #000000;
            height: 24px;
            background-color: #F0F0F0;
        }

        .list_rightBorder {
        border-right: 1px solid #BFBFBF;
        }

        .listFooter {
        background: #F7F7F7;
        border-top: 1px solid #D9D9D9;
        font-weight: bold;
        }

        .complexList {
        margin-top: 0px;
        border-right: 1px solid #B1B1B1;
        border-left: 1px solid #B1B1B1;
        border-bottom: 1px solid #B1B1B1;
        }

        .complexList td {
            padding-left: 5px;
            border-top: 1px solid #B1B1B1;
        }

        .complexList th {
            padding-left: 5px;
            font-family: Verdana, Arial, sans-serif;
            font-size: 10pt;
            font-weight: bold;
            color: #000000;
            height: 24px;
            border-right: 1px solid #B1B1B1;
            border-top: 1px solid #B1B1B1;
        }

        .complexList th a {
            font-family: Verdana, Arial, sans-serif;
            font-size: 10pt;
            font-weight: bold;
        }

        .complexList thead,.head {
            background-color: #F0F0F0;
        }

         /*Folder document view styles */
        .treeDocumentListViewTable {
        padding-left: 20px;
        padding-bottom: 2px;
        }

        .treeDocumentListViewContent {
        padding-left: 40px;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 8pt;
        color: #000000;
        }

        .treeDocumentListViewContent a {
            font-size: 8pt;
            color: #0000FF;
        }

        .treeDocumentListViewTable th {
            font-weight: bold;
            padding-left: 0px;
            padding-top: 1px;
            font-size: 10pt;
        }

        .treeDocumentListTable {
        padding-bottom: 2px;
        }

        .treeDocumentListTable th {
            font-weight: bold;
            padding-left: 10px;
            padding-top: 1px;
            font-size: 10pt;
        }

        .treeDocumentListTable td {
            padding-left: 10px;
            padding-right: 2px;
            padding-top: 1px;
            padding-bottom: 1px;
        }

        .dampedText {
        color: #888888 !important;
        }

        /* mt*/
        .underlined {
            border-bottom: 1px solid #000000;
        }

        .b_left {
            border-left: 1px solid #000000;
        }

        .b_right {
            border-right: 1px solid #000000;
        }

        .b_bottom {
            border-bottom: 1px solid #000000;
        }

        .b_top {
            border-top: 1px solid #000000;
        }

        .b_light_left {
        border-left: 1px solid #CCCCCC;
        }

        .b_light_right {
        border-right: 1px solid #CCCCCC;
        }

        .b_light_bottom {
        border-bottom: 1px solid #CCCCCC;
        }

        .b_light_top {
        border-top: 1px solid #CCCCCC;
        }

        .item_cell {
            height: 4mm;
        }

        .name_cell {
            height: 4mm;
            padding-right: 2mm;
        }

        .docNameLabels {
            padding-top: 1mm;
            padding-bottom: 1mm;
            padding-left: 3mm;
            padding-right: 3mm;
        }

        .docNameValues {
            border-width: 2px !important;
        }

        .mainTable td {
            text-align: center;
            font-family: Verdana, Arial, Helvetica, sans-serif !important;
            font-size: 7pt;
            color: #000000 !important;
            padding: 1px;
        }

        .mainTable_normal td {
            text-align: center;
            font-family: Verdana, Arial, Helvetica, sans-serif !important;
            font-size: 7pt;
            color: #000000 !important;
            padding: 1px;
        }

        .normalfont_cell td {
            font-size: 10pt !important;
        }

        .boldborders td {
            border-width: 2px !important;
        }

        .totals td {
            font-weight: bold;
        }

        .normalFont {
            font-weight: normal !important;
        }

        .rightAlign {
            text-align: right !important;
        }

        .leftAlign {
            text-align: left !important;
        }

        .cellComment {
            font-size: 6pt !important;
        }

        .reportSmallFont {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 7pt;
            color: #000000;
        }

        .separatorCell {
            font-size: 1pt !important;
            height: 5px;
        }

        p {
            padding: 0px;
            margin-top: 8px;
            margin-bottom: 8px;
        }

        .reportMiddleFont,.reportMiddleFont td,.reportMiddleFont li {
        font-size: 8pt !important;
        }
        .stamp {
            height: 100px;
            width: 100px;
            position: absolute;
            top: -50px;
        }
    </style>
</head>
<body>

<div align=right>
    <table cellpadding="0" cellspacing="0" border="0" style="width: 100mm">
        <tr>
            <td class=reportSmallFont align=left>Приложение № 1<br>
                к Правилам ведения журналов учета полученных и выставленных
                счетов-фактур, книг покупок и книг продаж при расчетах по налогу на
                добавленную стоимость, утвержденным постановлением Правительства РФ от
                02.12.2000 № 914 (в ред. Постановления Правительства РФ от 15.03.2001
                г. № 189, от 27.07.2002 № 575, от 16.02.2004 № 84, от 11.05.2006 №
                283, от 26.05.2009 № 451)</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
</div>

<table cellpadding="0" cellspacing="0" border="0"
       class="mainTable_normal" width="100%">
    <tr>
        <td><b>СЧЁТ-ФАКТУРА № <span class="inline_edit">{{ $orderNumber }}</span> от <span class="inline_edit"> {{ date('d.m.Y') }}г.</span></b></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>

<table cellpadding="0" cellspacing="0" border="0"
       class="mainTable_normal">
    <tr>
        <td class=leftAlign>Продавец:</td>
        <td class="leftAlign underlined"><b>{{ $selfFirm->organisation_name }}</b></td>
    </tr>
    <tr>
        <td class=leftAlign>Адрес:</td>
        <td class="leftAlign underlined"><b>{{ $selfFirm->place_address }},&nbsp;(тел.:&nbsp;{{ $selfFirm->phone }})</b></td>
    </tr>
    <tr>
        <td class=leftAlign>ИНН/КПП продавца:</td>
        <td class="leftAlign underlined"><b>{{ $selfFirm->inn }}/{{ $selfFirm->kpp }}</b></td>
    </tr>
    <tr>
        <td class=leftAlign>Грузоотправитель и его адрес:</td>
        <td class="leftAlign underlined"><b>{{ $selfFirm->organisation_name }},&nbsp;{{ $selfFirm->place_address }},&nbsp;(тел.:&nbsp;{{ $selfFirm->phone }}), р/счет № {{ $selfFirm->rs }}в {{ $selfFirm->bank }}, кор/счет № {{ $selfFirm->ks }}, БИК {{ $selfFirm->bik }}</b></td>
    </tr>
    <tr>
        <td class=leftAlign>Грузополучатель и его адрес:</td>
        <td class="leftAlign underlined"><b class="inline_edit">
                {{ $firm->organisation_name }},&nbsp;{{ $firm->place_address }},&nbsp;(тел.:&nbsp;{{ $firm->phone }}), р/счет № {{ $firm->rs }}в {{ $firm->bank }}, кор/счет № {{ $firm->ks }}, БИК {{ $firm->bik }}</b></td>
    </tr>
    <tr>
        <td colspan=2>&nbsp;</td>
    </tr>
    <tr>
        <td class=leftAlign colspan="2">К платежно-расчетному документу: №
            <table style="display:inline;"><tr>
                    <td class="underlined inline_edit" style="width:60mm;">{{ $orderNumber }}</td>
                    <td>от </td>
                    <td class="underlined inline_edit" style="width:50mm;">{{ date('d.m.Y') }}г.</td>
                </tr></table>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="mainTable_normal">
    <tr>
        <td class=leftAlign>Покупатель:</td>
        <td class="leftAlign underlined"><b class="inline_edit">{{ $firm->organisation_name }}</b></td>
    </tr>
    <tr>
        <td class=leftAlign>Адрес:</td>
        <td class="leftAlign underlined"><b class="inline_edit">
                {{ $firm->place_address }}</b></td>
    </tr>
    <tr>
        <td class=leftAlign>ИНН/КПП покупателя:</td>
        <td class="leftAlign underlined">
            <table style="display:inline;"><tr>
                    <td style="width:50mm;font-weight: bold;" class="inline_edit">{{ $firm->inn }}</td>
                    <td style="font-weight: bold;">/</td>
                    <td style="width:50mm;font-weight: bold;" class="inline_edit">{{ $firm->kpp }}</td>
                </tr></table>
        </td>
    </tr>
    <tr>
        <td colspan=2>&nbsp;</td>
    </tr>
    <tr>
        <td colspan=2>&nbsp;</td>
    </tr>
</table>

<table width="100%" border="0" cellpadding=0 cellspacing=0
       class="mainTable_normal">
    <tr>
        <td class="b_left b_top">
            Наименование товара (описание выполненных<br> работ, оказанных услуг),<br/>имущественного права
        </td>
        <td class="b_left b_top">
            Ед.<br>изм.
        </td>
        <td class="b_left b_top">
            Кол-<br>во
        </td>
        <td class="b_left b_top">Цена (тариф)<br>за ед. изм.
        </td>
        <td class="b_left b_top">
            Стоимость товаров<br>(работ, услуг),<br>имущественных прав,<br>всего без налога
        </td>
        <td class="b_left b_top">В т.ч.<br>акциз
        </td>
        <td class="b_left b_top">Налоговая<br>ставка
        </td>
        <td class="b_left b_top">Сумма<br>налога
        </td>
        <td class="b_left b_top">
            Стоимость товаров<br>(работ, услуг),<br>имущественных прав,<br>всего с учетом налога
        </td>
        <td class="b_left b_top">Страна<br>происхождения</td>
        <td class="b_left b_top b_right">№ таможенной<br>декларации</td>
    </tr>
    <tr>
        <td class="b_left b_top">1</td>
        <td class="b_left b_top">2</td>
        <td class="b_left b_top">3</td>
        <td class="b_left b_top">4</td>
        <td class="b_left b_top">5</td>
        <td class="b_left b_top">6</td>
        <td class="b_left b_top">7</td>
        <td class="b_left b_top">8</td>
        <td class="b_left b_top">9</td>
        <td class="b_left b_top">10</td>
        <td class="b_left b_top b_right">11</td>
    </tr>
    <?
    $totalAmount = 0;
    $totalSumWithoutNds = 0;
    $totalNds = 0;
    $totalSumWithNds = 0;
    ?>
    @foreach($products as $product)
        <tr>
            <td class="b_left b_top">{{ $product['product_name'] }}</td>
            <td class="b_left b_top">шт</td>
            <td class="b_left b_top">{{ $totalAmount += $product['product_amount'] }}</td>
            <td class="b_left b_top">{{ $product['product_price'] }}</td>
            <?
            $sumWithNds = $product['product_amount'] * $product['product_price'];
            $nds = $sumWithNds * 0.18;
            $sumWithoutNds = $sumWithNds - $nds;
            ?>
            <td class="b_left b_top">{{ $totalSumWithoutNds += $sumWithoutNds }}</td>
            <td class="b_left b_top">&nbsp;</td>
            <td class="b_left b_top">18</td>
            <td class="b_left b_top">{{ $totalNds += $nds }}</td>
            <td class="b_left b_top">{{ $totalSumWithNds += $sumWithNds }}</td>
            <td class="b_left b_top">Россия</td>
            <td class="b_left b_top">-------------</td>
        </tr>
    @endforeach
    <tr class=totals>
        <td colspan=7 class="b_left b_top b_bottom">
            <table class=mainTable_normal border="0" cellpadding=0 cellspacing=0
                   width="100%">
                <tr>
                    <td class="leftAlign nobr"><b>Всего к оплате</b></td>
                    <td class="rightAlign nobr"><b>{{ \App\Models\Order::num2str($totalSumWithoutNds) }}, без налога (НДС)</b></td>
                </tr>
            </table>
        </td>
        <td class="b_left b_top b_bottom rightAlign">{{ $totalNds }}</td>
        <td class="b_left b_top b_bottom rightAlign nobr">{{ $totalSumWithNds }}</td>
        <td class="b_left b_top">&nbsp;</td>
        <td class="b_top">&nbsp;</td>
    </tr>
</table>

<table cellpadding="0" cellspacing="0" border="0"
       class="mainTable_normal" width="100%">
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>

<table cellpadding="0" cellspacing="0" border="0"
       class="mainTable_normal" width="100%">
    <tr>
        <td style="width: 45mm" class="nobr"><b>{{ $selfFirm->face_position }}</b></td>
        <td class=underlined>&nbsp;</td>
        <td style="width: 5mm">&nbsp;</td>
        <td class="underlined nobr" style="width: 45mm"><b>{{ $selfFirm->face_fio }}</b></td>
        <td style="width: 15mm">&nbsp;</td>
        <td style="width: 55mm" class="nobr"><b>Главный бухгалтер</b></td>
        <td class=underlined>&nbsp;</td>
        <td style="width: 5mm">{{ $selfFirm->accauntant_fio }}</td>
        <td class="underlined nobr" style="width: 45mm"><b>&nbsp;</b></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td class=smallFont>подпись</td>
        <td>&nbsp;</td>
        <td class=smallFont>расшифровка подписи</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td class=smallFont>подпись</td>
        <td>&nbsp;</td>
        <td class=smallFont>расшифровка подписи</td>
    </tr>
</table>

<table cellpadding="0" cellspacing="0" border="0"
       class="mainTable_normal" width="100%">
    <tr>
        <td class="nobr" valign="bottom" style="width: 55mm"><b>Индивидуальный предприниматель</b></td>
        <td class="underlined" style="width: 45mm">&nbsp;</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="underlined nobr" valign="bottom"><b>&nbsp;</b></td>
        <td style="width: 5mm">&nbsp;</td>
        <td class="underlined nobr" valign="bottom"><b>&nbsp;</b></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td class=smallFont>подпись</td>
        <td>&nbsp;</td>
        <td class=smallFont>расшифровка подписи</td>
        <td>&nbsp;</td>
        <td class=smallFont>(реквизиты свидетельства о государственной регистрации<br/>индивидуального предпринимателя)</td>
    </tr>
</table>

<br/>
<br/>
<p>Примечание. Первый экземпляр - покупателю, второй экземпляр - продавцу.</p>

</body>
</html>