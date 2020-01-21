<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pandg extends Model
{
    protected $guarded = [];

    public function getRateAttribute($value) {
        return $value / 100;
    }
    public function setRateAttribute($value) {
        $this->attributes['rate'] = $value * 100;
    }

    public function job()
    {
        return $this->belongsTo('App\Job');
    }

    public function category()
    {
        return $this->belongsTo('App\PandGCategory');
    }
}
