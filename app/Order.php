<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function job()
    {
        return $this->belongsTo(\App\Job::class);
    }

    public function files()
    {
        return $this->morphMany(\App\File::class, 'fileable');
    }
}
