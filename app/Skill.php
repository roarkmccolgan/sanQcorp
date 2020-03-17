<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $guarded = [];

    public function getRateAttribute($value)
    {
        return $value / 100;
    }

    public function setRateAttribute($value)
    {
        $this->attributes['rate'] = $value * 100;
    }

    public function employees()
    {
        return $this->hasMany('App\Employee');
    }
}
