<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function job()
    {
        return $this->belongsTo(\App\Job::class);
    }

    public function materials()
    {
        return $this->belongsToMany(\App\Material::class);
    }

    public function option()
    {
        return $this->belongsTo(\App\Option::class);
    }
}
