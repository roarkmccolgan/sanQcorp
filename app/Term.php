<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $guarded = [];

    public function system()
    {
        return $this->belongsToMany(\App\System::class);
    }

    public function job()
    {
        return $this->belongsToMany(\App\Job::class);
    }
}
