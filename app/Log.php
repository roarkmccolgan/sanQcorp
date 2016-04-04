<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Log extends Model
{
    use SoftDeletes;
    
    /**
     * @return Log Job
     */
    public function job()
    {
        return $this->belongsTo('App\Jobs');
    }

    /**
     * @return Log materials
     */
    public function materials()
    {
        return $this->belongsToMany('App\Materials');
    }

    /**
     * @return Log task
     */
    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
