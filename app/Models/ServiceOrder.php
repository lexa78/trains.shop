<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model {

    protected $guarded = ['id'];

    public function service_status()
    {
        return $this->belongsTo('App\Models\ServiceStatus');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function firm()
    {
        return $this->belongsTo('App\Models\Firm');
    }

    public function document()
    {
        return $this->hasMany('App\Models\Document');
    }


}
