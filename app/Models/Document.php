<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model {

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function service_order()
    {
        return $this->belongsTo('App\Models\ServiceOrder');
    }

}
