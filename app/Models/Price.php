<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model {

    protected $guarded = ['id'];

    public function stantion()
    {
        return $this->belongsToMany('App\Models\Stantion');
    }

    public function product()
    {
        return $this->belongsToMany('App\Models\Product');
    }

//    public function services()
//    {
//        return $this->hasOne('App\Models\Service');
//    }
//
    public function product_cart()
    {
        return $this->hasOne('App\Models\ProductCart');
    }

}
