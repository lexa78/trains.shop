<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {

    protected $guarded = ['id'];

    public function train_road()
    {
        return $this->hasMany('App\Models\TrainRoad');
    }

}
