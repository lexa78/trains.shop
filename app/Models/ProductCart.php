<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model {

    protected $guarded = ['id'];

    public function price()
    {
        return $this->belongsTo('App\Models\Price');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}
