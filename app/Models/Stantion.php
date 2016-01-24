<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stantion extends Model {

    protected $guarded = ['id'];

    public function train_road()
    {
        return $this->belongsTo('App\Models\TrainRoad');
    }

    public function products_in_order()
    {
        return $this->hasOne('App\Models\ProductsInOrder');
    }

    public function price()
    {
        return $this->belongsToMany('App\Models\Price');
    }

}
