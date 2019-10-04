<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function jobs()
    {
        return $this->belongsToMany('App\Jobs');
    }
}
