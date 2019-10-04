<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pandg extends Model
{
    protected $guarded = [];

    public function jobs()
    {
        return $this->belongsTo('App\Job');
    }

    public function category()
    {
        return $this->belongsTo('App\PandGCategory');
    }
}
