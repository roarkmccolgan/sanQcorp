<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * @return Section Job
     */
    public function job()
    {
        return $this->belongsTo('App\Jobs');
    }

    /**
     * @return Section task
     */
    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }
}
