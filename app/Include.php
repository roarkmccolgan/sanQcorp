<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Include extends Model
{
    protected $guarded = [];

    public function job()
    {
        return $this->belongsToMany('App\Job');
    }
}
