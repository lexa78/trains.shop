<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $guarded = ['id'];

    private static $VAT_rate = [
        1 => '18%',
        2 => '10%',
        3 => '0%',
        4 => 'Без НДС'
    ];

    private static $VAT_calculation = [
        1 => 0.18,
        2 => 0.1,
        3 => 0,
        4 => -1
    ];

    public static function getAllVAT_rate()
    {
        return self::$VAT_rate;
    }

    public static function getAllVAT_rateByKey($key)
    {
        return self::$VAT_rate[$key];
    }

    public static function getVAT_calculationByKey($key)
    {
        return self::$VAT_calculation[$key];
    }

    public function condition()
    {
        return $this->belongsTo('App\Models\Condition');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function price()
    {
        return $this->belongsToMany('App\Models\Price');
    }

    public function product_cart()
    {
        return $this->hasMany('App\Models\ProductCart');
    }

    public function products_in_order()
    {
        return $this->hasMany('App\Models\ProductsInOrder');
    }

}
