<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model {

    protected $guarded = ['id'];

    public function order()
    {
        return $this->hasOne('App\Models\Order');
    }

}
