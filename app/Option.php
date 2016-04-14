<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * @return Task logs
     */
    public function logs()
    {
        return $this->hasMany('App\Log');
    }

    /**
     * @return Task sections
     */
    public function section()
    {
        return $this->belongsTo('App\Section');
    }
}