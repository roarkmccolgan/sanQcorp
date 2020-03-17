<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public function job()
    {
        return $this->belongsTo('App\Jobs');
    }
}
