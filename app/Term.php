<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = [
        'term',
        'default'
    ];

    /**
     * @return Term system
     */
    public function system()
    {
        return $this->belongsToMany('App\System');
    }

    /**
     * @return Term job
     */
    public function job()
    {
        return $this->belongsToMany('App\Jobs');
    }
}
