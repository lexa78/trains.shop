<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $guarded = ['id'];

    const IS_FIRST = 1;//статус заказа по умолчанию начальный
    const CANCELED = 2;//статус заказа отменен
    const COMPLETED = 5;//статус заказа выполнен
    const INVOICE_TYPE = 1; //счет
    const INVOICE_ACCT_TYPE = 2; //счет-фактура
    const AUCTION_12_TYPE = 3; //торг-12
    const CONTRACT_TYPE = 4; //договор
    const SUPPLEMENTARY_AGREEMENT_TYPE = 5; //доп. соглашение

    private static $documentTypes = [
        self::INVOICE_TYPE => 'schet',
        self::INVOICE_ACCT_TYPE => 'schet-factura',
        self::AUCTION_12_TYPE => 'torg-12',
        self::CONTRACT_TYPE => 'dogovor',
        self::SUPPLEMENTARY_AGREEMENT_TYPE => 'dop-soglashenie'
    ];

    public static function getDocTypeName($key)
    {
        return self::$documentTypes[$key];
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function firm()
    {
        return $this->belongsTo('App\Models\Firm');
    }

    public function products_in_order() {
        return $this->hasMany('App\Models\ProductsInOrder');
    }

    public function document()
    {
        return $this->hasMany('App\Models\Document');
    }

    public static function formatDate($date, $withTime = false)
    {
        $newDate = strtotime($date);
        if($withTime) {
            return date('d.m.Y  H:i:s', $newDate);
        } else {
            return date('d.m.Y', $newDate);
        }
    }

    public static function num2str($num) {
        $nul='ноль';
        $ten=array(
            array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
            array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
        );
        $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
        $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
        $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
        $unit=array( // Units
            array('копейка' ,'копейки' ,'копеек',	 1),
            array('рубль'   ,'рубля'   ,'рублей'    ,0),
            array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
            array('миллион' ,'миллиона','миллионов' ,0),
            array('миллиард','милиарда','миллиардов',0),
        );
        //
        list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub)>0) {
            foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit)-$uk-1; // unit key
                $gender = $unit[$uk][3];
                list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
                else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                // units without rub & kop
                if ($uk>1) $out[]= self::morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
            } //foreach
        }
        else $out[] = $nul;
        $out[] = self::morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
        $out[] = $kop.' '.self::morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
        return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
    }

    /**
     * Склоняем словоформу
     */
    private static function morph($n, $f1, $f2, $f5) {
        $n = abs(intval($n)) % 100;
        if ($n>10 && $n<20) return $f5;
        $n = $n % 10;
        if ($n>1 && $n<5) return $f2;
        if ($n==1) return $f1;
        return $f5;
    }
}
