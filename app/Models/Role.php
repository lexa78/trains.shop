<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    const ADMIN = 1;

    const CLIENT = 2;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

}
