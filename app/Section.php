<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';

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
        return $this->hasMany('App\Task');
    }
}
