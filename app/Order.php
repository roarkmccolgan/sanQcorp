<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function job()
    {
        return $this->belongsTo('App\Job');
    }

    public function files()
    {
        return $this->morphMany('App\File', 'fileable');
    }
}
