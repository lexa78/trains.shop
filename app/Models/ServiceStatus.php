<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceStatus extends Model {

    protected $guarded = ['id'];

    public function service_order()
    {
        return $this->hasMany('App\Models\ServiceOrder');
    }

}
