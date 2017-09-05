<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobInclude extends Model
{
    protected $fillable = [
        'item',
        'type'
    ];

    /**
     * @return Include job
     */
    public function job()
    {
        return $this->belongsToMany('App\Jobs');
    }
}
