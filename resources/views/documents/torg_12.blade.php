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

        /*.greatHeader {*/
            /*font-family: Verdana, Arial, sans-serif;*/
            /*font-size: 16pt;*/
            /*font-weight: normal;*/
            /*color: #000000;*/
            /*padding-left: 11px;*/
        /*}*/

        /*.header1 {*/
            /*font-family: Verdana, Arial, sans-serif;*/
            /*font-size: 13pt;*/
            /*color: #000000;*/
            /*padding-right: 10px;*/
            /*padding-bottom: 3px;*/
        /*}*/

        /*.smallFont {*/
            /*font-family: Verdana, Arial, Helvetica, sans-serif;*/
            /*font-size: 8pt;*/
            /*color: #000000;*/
        /*}*/

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

        /*.title {*/
            /*font-family: Verdana, Arial, sans-serif;*/
            /*font-size: 15pt;*/
            /*color: #000000;*/
            /*font-weight: normal;*/
            /*margin-top: 0px;*/
        /*}*/

        /*.header2 {*/
            /*font-family: Verdana, Arial, sans-serif;*/
            /*font-size: 14px;*/
            /*font-weight: bold;*/
            /*color: #362F2D;*/
        /*}*/

        /*.pageSubheader {*/
            /*font-family: Verdana, Arial, sans-serif;*/
            /*font-size: 12pt;*/
            /*color: #000000;*/
            /*font-weight: normal;*/
        /*}*/

        /*.smallhead {*/
            /*border-bottom: 0px;*/
        /*}*/

        /*.largeText {*/
            /*font-family: Verdana, Arial, sans-serif;*/
            /*font-size: 18px;*/
            /*font-weight: bold;*/
        /*}*/

        /*.largeText_normal {*/
            /*font-family: Verdana, Arial, sans-serif;*/
            /*font-size: 18px;*/
        /*}*/

        /*.greatText {*/
            /*font-family: Verdana, Arial, sans-serif;*/
            /*font-size: 22px;*/
            /*font-weight: bold;*/
        /*}*/

        /*.pageHeader {*/
            /*font-family: Verdana, Arial, sans-serif;*/
            /*font-size: 15pt;*/
            /*color: #000000;*/
            /*font-weight: normal;*/
            /*background-color: #F5EBD6;*/
            /*margin-top: 0px;*/
            /*padding-left: 10px;*/
            /*padding-top: 7px;*/
            /*padding-bottom: 5px;*/
        /*}*/

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

        /*.separator {*/
            /*overflow: hidden;*/
        /*}*/

        /*.list {*/
            /*margin-top: 0px;*/
            /*border: 1px solid #B1B1B1;*/
        /*}*/

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

        /*.list_rightBorder {*/
            /*border-right: 1px solid #BFBFBF;*/
        /*}*/

        /*.listFooter {*/
            /*background: #F7F7F7;*/
            /*border-top: 1px solid #D9D9D9;*/
            /*font-weight: bold;*/
        /*}*/

        /*.complexList {*/
            /*margin-top: 0px;*/
            /*border-right: 1px solid #B1B1B1;*/
            /*border-left: 1px solid #B1B1B1;*/
            /*border-bottom: 1px solid #B1B1B1;*/
        /*}*/

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

        /* Folder document view styles */
        /*.treeDocumentListViewTable {*/
            /*padding-left: 20px;*/
            /*padding-bottom: 2px;*/
        /*}*/

        /*.treeDocumentListViewContent {*/
            /*padding-left: 40px;*/
            /*font-family: Verdana, Arial, Helvetica, sans-serif;*/
            /*font-size: 8pt;*/
            /*color: #000000;*/
        /*}*/

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

        /*.treeDocumentListTable {*/
            /*padding-bottom: 2px;*/
        /*}*/

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

        /*.dampedText {*/
            /*color: #888888 !important;*/
        /*}*/

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

        /*.b_light_left {*/
            /*border-left: 1px solid #CCCCCC;*/
        /*}*/

        /*.b_light_right {*/
            /*border-right: 1px solid #CCCCCC;*/
        /*}*/

        /*.b_light_bottom {*/
            /*border-bottom: 1px solid #CCCCCC;*/
        /*}*/

        /*.b_light_top {*/
            /*border-top: 1px solid #CCCCCC;*/
        /*}*/

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

        /*.reportMiddleFont,.reportMiddleFont td,.reportMiddleFont li {*/
            /*font-size: 8pt !important;*/
        /*}*/
        .stamp {
            height: 100px;
            width: 100px;
            position: absolute;
            top: -50px;
        }
    </style>
</head>
<body>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td class=reportSmallFont align=right>Унифицированная форма №
            Торг-12<br>Утверждена Постановлением Госкомстата России
            <br>от 25.12.1998 г. за №132
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td valign=top width="90%">
            <table cellpadding="0" cellspacing="0" border="0" width="100%"	class="mainTable">
                <tr>
                    <td class=underlined align=center><b>
                            {{ $selfFirm->organisation_name }},&nbsp;{{ $selfFirm->place_address }},&nbsp;(тел.:{{ $selfFirm->phone }})</b>
                    </td>
                </tr>
                <tr>
                    <td class=underlined align=center><b>
                            р/счет № {{ $selfFirm->rs }}в {{ $selfFirm->bank }}, кор/счет № {{ $selfFirm->ks }}, БИК {{ $selfFirm->bik }}
                        </b></td>
                </tr>
                <tr>
                    <td class="reportSmallFont underlined cellComment" align="center"	style="padding-top: 1mm; padding-bottom: 5mm">
                        грузоотправитель, адрес, номер телефона, банковские реквизиты</td>
                </tr>
                <tr>
                    <td class="reportSmallFont cellComment" align="center" style="padding-top: 1mm; padding-bottom: 2mm">
                        структурное	подразделение
                    </td>
                </tr>
            </table>

            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td class="reportSmallFont name_cell">Грузополучатель</td>
                    <td width="100%" class="reportSmallFont underlined">
                        <b class="inline_edit">
                            {{ $firm->organisation_name }},&nbsp;{{ $firm->place_address }},&nbsp;(тел.:{{ $firm->phone }})
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="reportSmallFont name_cell">Поставщик</td>
                    <td width="100%" class="reportSmallFont underlined">
                        <b>
                            {{ $selfFirm->organisation_name }},&nbsp;{{ $selfFirm->place_address }},&nbsp;(тел.:{{ $selfFirm->phone }})
                        </b>
                    </td>

                </tr>
                <tr>
                    <td class="reportSmallFont name_cell">Плательщик</td>
                    <td width="100%" class="reportSmallFont underlined">
                        <b class="inline_edit">
                            {{ $firm->organisation_name }},&nbsp;{{ $firm->place_address }},&nbsp;(тел.:{{ $firm->phone }})
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="reportSmallFont name_cell">Основание</td>
                    <td width="100%" class="reportSmallFont underlined"><b class="inline_edit">По заказу № {{ $orderNumber }}  от  {{ $orderDate }}г.</b></td>
                </tr>
                <tr>
                    <td colspan=2>&nbsp;</td>
            </table>

            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td align=center>

                        <table cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td rowspan=2 class="reportSmallFont docNameLabels" valign=bottom>
                                    <b>ТОВАРНАЯ	НАКЛАДНАЯ&nbsp;</b>
                                </td>
                                <td class="reportSmallFont docNameLabels b_top b_left b_right" align="center">
                                    Номер<br>документа
                                </td>
                                <td class="reportSmallFont docNameLabels b_top b_right"	align="center">
                                    Дата<br>составления
                                </td>
                            </tr>

                            <tr>
                                <td
                                        class="reportSmallFont docNameLabels b_top b_left b_bottom b_right docNameValues"
                                        align=center>
                                    <b class="inline_edit">{{ $orderNumber }}</b>
                                </td>
                                <td
                                        class="reportSmallFont docNameLabels b_top b_right b_bottom docNameValues"
                                        align=center>
                                    <b class="inline_edit">{{ date('d.m.Y') }}г.</b>
                                </td>
                            </tr>

                            <tr>
                                <td colspan=3 class=separatorCell>&nbsp;</td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>
        </td>

        <td valign=top align=right>

            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td colspan=2 class=reportSmallFont>&nbsp;</td>
                    <td style="width: 20mm"
                        class="item_cell b_left b_bottom b_top b_right reportSmallFont"
                        align=center>Код</td>
                </tr>
                <tr>
                    <td class="reportSmallFont name_cell nobr" colspan=2 align=right>Форма
                        по ОКУД</td>
                    <td style="width: 20mm"
                        class="item_cell b_left b_bottom b_right reportSmallFont"
                        align=center>0330212</td>
                </tr>
                <tr>
                    <td class="reportSmallFont name_cell nobr" colspan=2 align=right>по
                        ОКПО</td>
                    <td style="width: 20mm"
                        class="item_cell b_left b_bottom b_right reportSmallFont"
                        align=center>&nbsp;</td>
                </tr>
                <tr>
                    <td class="reportSmallFont name_cell nobr" colspan=2 align=right>Вид
                        деятельности по ОКДП</td>
                    <td style="width: 20mm"
                        class="item_cell b_left b_bottom b_right reportSmallFont"
                        align=center>&nbsp;</td>
                </tr>
                <tr>
                    <td class="reportSmallFont name_cell nobr" colspan=2 align=right>по
                        ОКПО</td>
                    <td style="width: 20mm"
                        class="item_cell b_left b_bottom b_right reportSmallFont"
                        align=center>&nbsp;</td>
                </tr>
                <tr>
                    <td class="reportSmallFont name_cell nobr" colspan=2 align=right>по
                        ОКПО</td>
                    <td style="width: 20mm"
                        class="item_cell b_left b_bottom b_right reportSmallFont"
                        align=center>&nbsp;</td>
                </tr>
                <tr>
                    <td class="reportSmallFont">&nbsp;</td>
                    <td class="reportSmallFont name_cell b_bottom nobr" align=right>по
                        ОКПО</td>
                    <td style="width: 20mm"
                        class="item_cell b_left b_bottom b_right reportSmallFont"
                        align=center>&nbsp;</td>
                </tr>
                <tr>
                    <td rowspan="2">&nbsp;</td>
                    <td style="width: 20mm"
                        class="name_cell item_cell b_left b_bottom reportSmallFont"
                        align=right>номер</td>
                    <td style="width: 20mm"
                        class="item_cell b_left b_bottom b_right reportSmallFont inline_edit"
                        align=center>&nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 20mm"
                        class="name_cell item_cell b_left b_bottom reportSmallFont"
                        align=right>дата</td>
                    <td style="width: 20mm"
                        class="item_cell b_left b_bottom b_right reportSmallFont inline_edit"
                        align=center>&nbsp;</td>
                </tr>
                <tr>
                    <td class="reportSmallFont name_cell nobr" rowspan="2" valign="top">Транспортная
                        накладная</td>
                    <td style="width: 20mm"
                        class="name_cell item_cell b_left b_bottom reportSmallFont"
                        align=right>номер</td>
                    <td style="width: 20mm"
                        class="item_cell b_left b_bottom b_right reportSmallFont"
                        align=center>&nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 20mm"
                        class="name_cell item_cell b_left b_bottom reportSmallFont"
                        align=right>дата</td>
                    <td style="width: 20mm"
                        class="item_cell b_left b_bottom b_right reportSmallFont"
                        align=center>&nbsp;</td>
                </tr>
                <tr>
                    <td class="reportSmallFont name_cell nobr" colspan=2 align=right>Вид
                        операции</td>
                    <td style="width: 20mm"
                        class="item_cell b_left b_bottom b_right reportSmallFont"
                        align=center>&nbsp;</td>
                </tr>
            </table>

        </td>
    </tr>
</table>

<table width="100%" border="0" cellpadding=0 cellspacing=0
       class="mainTable">
    <tr>
        <td rowspan="2" class="b_top b_left"><b>№<br>
                п/п</b></td>
        <td colspan="2" class="b_top b_left b_bottom"><b>Товар</b></td>
        <td colspan="2" class="b_top b_left b_bottom"><b>Ед. изм.</b></td>
        <td rowspan="2" class="b_top b_left"><b>Вид<br>упа-<br>ков-<br>ки</b></td>
        <td colspan="2" class="b_top b_left b_bottom"><b>Количество</b></td>
        <td rowspan="2" class="b_top b_left"><b>Масса<br>брутто</b></td>
        <td rowspan="2" class="b_top b_left"><b>Количество<br>(масса<br>нетто)</b></td>
        <td rowspan="2" class="b_top b_left"><b>Цена, руб.<br>коп.</b></td>
        <td rowspan="2" class="b_top b_left"><b>Сумма без<br>учета НДС<br>руб. коп.</b></td>
        <td colspan="2" class="b_top b_left b_bottom"><b>НДС</b></td>
        <td rowspan="2" class="b_top b_left b_right"><b>Сумма с<br>учетом НДС<br>руб. коп.</b></td>
    </tr>
    <tr>
        <td class="b_left">наименование, характеристика,<br>сорт, артикул товара</td>
        <td class="b_left">Код</td>
        <td class="b_left">Наиме-<br>нование</td>
        <td class="b_left">код<br>по<br>ОКЕИ</td>
        <td class="b_left">в од-<br>ном<br>месте</td>
        <td class="b_left">мест,<br>штук</td>
        <td class="b_left">ставка, %</td>
        <td class="b_left">сумма руб.<br>коп.</td>
    </tr>
    <tr class=boldborders>
        <td class="b_left b_top b_bottom">1</td>
        <td class="b_left b_top b_bottom">2</td>
        <td class="b_left b_top b_bottom">3</td>
        <td class="b_left b_top b_bottom">4</td>
        <td class="b_left b_top b_bottom">5</td>
        <td class="b_left b_top b_bottom">6</td>
        <td class="b_left b_top b_bottom">7</td>
        <td class="b_left b_top b_bottom">8</td>
        <td class="b_left b_top b_bottom">9</td>
        <td class="b_left b_top b_bottom">10</td>
        <td class="b_left b_top b_bottom">11</td>
        <td class="b_left b_top b_bottom">12</td>
        <td class="b_left b_top b_bottom">13</td>
        <td class="b_left b_top b_bottom">14</td>
        <td class="b_left b_top b_bottom b_right">15</td>
    </tr>
    <?
        $totalAmount = 0;
        $totalSumWithoutNds = 0;
        $totalNds = 0;
        $totalSumWithNds = 0;
    ?>
    @foreach($products as $key => $product)
        <tr>
            <td class="b_left b_top b_bottom">{{ $key+1 }}</td>
            <td class="b_left b_top b_bottom">{{ $product['product_name'] }}</td>
            <td class="b_left b_top b_bottom">&nbsp;</td>
            <td class="b_left b_top b_bottom">шт</td>
            <td class="b_left b_top b_bottom">&nbsp;</td>
            <td class="b_left b_top b_bottom">&nbsp;</td>
            <td class="b_left b_top b_bottom">1</td>
            <td class="b_left b_top b_bottom">{{ $product['product_amount'] }}</td>
            <td class="b_left b_top b_bottom">&nbsp;</td>
            <td class="b_left b_top b_bottom">{{ $product['product_amount'] }}</td>
            <td class="b_left b_top b_bottom">{{ $product['product_price'] }}</td>
            <?
                $sumWithNds = $product['product_amount'] * $product['product_price'];
                $nds = $sumWithNds * 0.18;
                $sumWithoutNds = $sumWithNds - $nds;
            ?>
            <td class="b_left b_top b_bottom">{{ $sumWithoutNds }}</td>
            <td class="b_left b_top b_bottom">18</td>
            <td class="b_left b_top b_bottom">{{ $nds }}</td>
            <td class="b_left b_top b_bottom b_right">{{ $sumWithNds }}</td>
        </tr>
        <?
            $totalAmount += $product['product_amount'];
            $totalSumWithoutNds += $sumWithoutNds;
            $totalNds += $nds;
            $totalSumWithNds += $sumWithNds;
        ?>
    @endforeach
    <tr>
        <td colspan="7" align="right" class="rightAlign">Итого</td>
        <td class="b_left b_bottom">X</td>
        <td class="b_left b_bottom">X</td>
        <td class="b_left b_bottom rightAlign nobr">{{ $totalAmount }}</td>
        <td class="b_left b_bottom">X</td>
        <td class="b_left b_bottom rightAlign nobr">{{ $totalSumWithoutNds }}</td>
        <td class="b_left b_bottom">X</td>
        <td class="b_left b_bottom rightAlign nobr">{{ $totalNds }}</td>
        <td class="b_left b_bottom b_right rightAlign nobr">{{ $totalSumWithNds }}</td>
    </tr>
    <tr class=totals>
        <td colspan="7" align="right" class="rightAlign normalFont ">Всего
            по накладной</td>
        <td class="b_left b_bottom">&nbsp;</td>
        <td class="b_left b_bottom">&nbsp;</td>
        <td class="b_left b_bottom rightAlign">{{ $totalAmount }}</td>
        <td class="b_left b_bottom normalFont">X</td>
        <td class="b_left b_bottom rightAlign nobr">{{ $totalSumWithoutNds }}</td>
        <td class="b_left b_bottom normalFont">X</td>
        <td class="b_left b_bottom rightAlign">{{ $totalNds }}</td>
        <td class="b_left b_bottom b_right rightAlign nobr">{{ $totalSumWithNds }}</td>
    </tr>
</table>

<table width="100%" border="0" cellpadding=0 cellspacing=0
       class="mainTable">
    <tr>
        <td class=separatorCell>&nbsp;</td>
    </tr>
</table>

<table width="100%" border="0" cellpadding=0 cellspacing=0
       class="mainTable">
    <tr>
        <td class="nobr">Товарная накладная имеет приложение на</td>
        <td style="width: 40%" class="underlined">&nbsp;</td>
        <td class="nobr">и содержит</td>
        <td style="width: 40%" class=underlined><b>{{ \App\Models\Order::num_propis($key + 1) }}</b></td>
        <td class="nobr">порядковых номеров записей</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td class="reportSmallFont cellComment">прописью</td>
        <td>&nbsp;</td>
    </tr>
</table>

<table width="100%" border="0" cellpadding=0 cellspacing=0
       class="mainTable">
    <tr>
        <td class=separatorCell>&nbsp;</td>
    </tr>
</table>

<table width="100%" border="0" cellpadding=0 cellspacing=0
       class="mainTable">
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td class="rightAlign">Масса груза (нетто)</td>
        <td class=underlined><b>&nbsp;</b></td>
        <td class="b_top b_left b_bottom b_right" style="width: 30mm">&nbsp;</td>
        <td class="leftAlign" style="width: 20mm">кг</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td class=cellComment>прописью</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 20mm" class="leftAlign nobr">Всего мест</td>
        <td style="width: 50%" class=underlined><b>{{ \App\Models\Order::num_propis($totalAmount) }}</b></td>
        <td class="rightAlign">Масса груза (брутто)</td>
        <td class=underlined><b>&nbsp;</b></td>
        <td class="b_top b_left b_bottom b_right" style="width: 30mm">&nbsp;</td>
        <td class="leftAlign" style="width: 20mm">кг</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td class=cellComment>прописью</td>
        <td>&nbsp;</td>
        <td class=cellComment>прописью</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>

<table width="100%" border="0" cellpadding=0 cellspacing=0
       class="mainTable">
    <tr>
        <td class=separatorCell>&nbsp;</td>
    </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0 width="100%">
    <tr>

        <td width="50%">

            <table width="100%" border="0" cellpadding=0 cellspacing=0
                   class="mainTable">
                <tr>
                    <td class="nobr">Приложение (паспорта, сертификаты, и т.п.)</td>
                    <td width="80%" class=underlined>&nbsp;</td>
                    <td>листах</td>
                </tr>
            </table>

            <table width="100%" border="0" cellpadding=0 cellspacing=0
                   class="mainTable">
                <tr>
                    <td class=leftAlign>Всего отпущено на сумму</td>
                </tr>
                <tr>
                    <td class="underlined leftAlign"><b>{{ \App\Models\Order::num2str($totalSumWithNds) }}, <br>в том числе без налога (НДС) {{ \App\Models\Order::num2str($totalSumWithoutNds) }}</b></td>
                </tr>
                <tr>
                    <td class=separatorCell>&nbsp;</td>
                </tr>
            </table>

            <table width="100%" border="0" cellpadding=0 cellspacing=0
                   class="mainTable">
                <tr>
                    <td class="leftAlign nobr">Отпуск разрешил</td>
                    <td class=underlined style="width: 30%">{{ $selfFirm->face_position }}</td>
                    <td>&nbsp;</td>
                    <td class=underlined style="width: 30%">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class=underlined><b>{{ \App\Models\Order::getLastNameWithFirstLetters($selfFirm->face_fio) }}</b></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class=cellComment>должность</td>
                    <td>&nbsp;</td>
                    <td class=cellComment>подпись</td>
                    <td>&nbsp;</td>
                    <td class="cellComment nobr">расшифровка подписи</td>
                </tr>
                <tr>
                    <td class=leftAlign>&nbsp;</td>
                    <td class=underlined>Гл. Бухгалтер</td>
                    <td>&nbsp;</td>
                    <td class=underlined>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class=underlined><b>{{ \App\Models\Order::getLastNameWithFirstLetters($selfFirm->accountant_fio) }}</b></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class=cellComment>должность</td>
                    <td>&nbsp;</td>
                    <td class=cellComment>подпись</td>
                    <td>&nbsp;</td>
                    <td class="cellComment nobr">расшифровка подписи</td>
                </tr>
            </table>

            <table border="0" cellpadding=0 cellspacing=0
                   class="mainTable">
                <tr>
                    <td width="90">М.П.<img src="{{ asset('/invoices/stamp.jpg') }}" class="stamp"></td>
                    <td style="padding-left:100px;" class="inline_edit">&nbsp;</td>
                </tr>
            </table>

        </td>

        <td style="padding-left: 5px">&nbsp;</td>

        <td width="50%" valign=top>

            <table width="100%" border="0" cellpadding=0 cellspacing=0
                   class="mainTable">
                <tr>
                    <td class="leftAlign nobr">По доверенности №</td>
                    <td class=underlined style="width: 85%">&nbsp;</td>
                </tr>
                <tr>
                    <td class=separatorCell>&nbsp;</td>
                    <td class=separatorCell>&nbsp;</td>
                </tr>
            </table>

            <table width="100%" border="0" cellpadding=0 cellspacing=0
                   class="mainTable">
                <tr>
                    <td class=leftAlign>Выданной</td>
                    <td class=underlined style="width: 90%">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="cellComment nobr">кем, кому (организация,
                        должность, фамилия, и.о.)</td>
                </tr>
            </table>

            <table width="100%" border="0" cellpadding=0 cellspacing=0
                   class="mainTable">
                <tr>
                    <td class="leftAlign nobr">Груз принял</td>
                    <td class=underlined style="width: 90%">&nbsp;</td>
                </tr>
            </table>

            <table width="100%" border="0" cellpadding=0 cellspacing=0
                   class="mainTable">
                <tr>
                    <td class=separatorCell>&nbsp;</td>
                    <td class=separatorCell>&nbsp;</td>
                </tr>
                <tr>
                    <td align=left class="nobr">Груз получил грузополучатель</td>
                    <td class=underlined style="width: 90%">&nbsp;</td>
                </tr>
            </table>

            <table border="0" cellpadding=0 cellspacing=0
                   class="mainTable">
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td width="90">М.П.</td>
                    <td style="padding-left:100px;" class="inline_edit">&nbsp;</td>
                </tr>
            </table>

        </td>

    </tr>
</table>

</body>
</html>