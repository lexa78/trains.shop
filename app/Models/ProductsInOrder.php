<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsInOrder extends Model {

    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function stantion()
    {
        return $this->belongsTo('App\Models\Stantion');
    }

    public function price()
    {
        return $this->belongsTo('App\Models\Price');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}
