<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factory extends Model {

    protected $guarded = ['id'];

    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }

}
