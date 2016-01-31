<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $guarded = ['id'];

    public function year()
    {
        return $this->belongsTo('App\Models\Year');
    }

    public function factory()
    {
        return $this->belongsTo('App\Models\Factory');
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
