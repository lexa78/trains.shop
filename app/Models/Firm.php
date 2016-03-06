<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model {

    protected $guarded = ['id'];

    public function user()
	{
		return $this->hasOne('App\Models\User');
	}

    public function order()
	{
		return $this->hasMany('App\Models\Order');
	}

    public function service_order()
	{
		return $this->hasMany('App\Models\ServiceOrder');
	}

}
