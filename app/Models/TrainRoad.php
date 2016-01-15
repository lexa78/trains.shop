<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainRoad extends Model {

    protected $guarded = ['id'];

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function stantion()
    {
        return $this->hasMany('App\Models\Stantion');
    }
}
